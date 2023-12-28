<?php

namespace App\Http\Controllers;

use App\Models\Gor;
use App\Models\Field;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FieldCategory;
use App\Http\Requests\StoreGor;
use App\Http\Requests\StoreField;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreFieldCategory;
use App\Http\Requests\UpdateField;
use App\Http\Requests\UpdateFieldCategory;
use App\Http\Requests\UpdateGor;
use App\Http\Requests\UpdateRenter;
use App\Models\BannedRenter;
use App\Models\DetailField;
use App\Models\OwnerSubscription;
use App\Models\Renter;
use App\Models\TimeField;

class MasterOwnerController extends Controller
{
    public function renter_index()
    {
        return view('pages.owner.data-master.renter.index');
    }

    public function renter_edit(Renter $renter)
    {
        return view('pages.owner.data-master.renter.edit', compact('renter'));
    }

    public function renter_update_status(Renter $renter)
    {
        DB::transaction(function () use ($renter) {
            if (BannedRenter::where('owner_id', auth()->user()->owner->id)->where('renter_id', $renter->id)->count() == 0) {
                BannedRenter::create([
                    'owner_id' => auth()->user()->owner->id,
                    'renter_id' => $renter->id
                ]);
            } else {
                BannedRenter::where('owner_id', auth()->user()->owner->id)
                            ->where('renter_id', $renter->id)
                            ->delete();
            }
        });

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Ubah Status Penyewa Berhasil!'
        ]);
    }

    public function gor_index()
    {
        return view('pages.owner.data-master.gor.index');
    }

    public function gor_create()
    {
        return view('pages.owner.data-master.gor.create');
    }

    public function gor_store(StoreGor $request)
    {
        $owner_subscription = OwnerSubscription::where('owner_id', auth()->user()->owner->id)->first();

        if ($owner_subscription->subscription_id == 1 && Gor::where('owner_id', auth()->user()->owner->id)->count() == 1) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'Tambah Gor Hanya Dibatasi 1!'
            ]);
        }

        if ($request->validated()) {
            DB::transaction(function () use ($request) {
                $gor = Gor::create([
                    'owner_id' => auth()->user()->owner->id,
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'price' => $request->price,
                    'address' => $request->address
                ]);

                if ($request->hasFile('gor_image')) {
                    $gor->addMediaFromRequest('gor_image')->withResponsiveImages()->toMediaCollection('gor_image');
                }
            });

            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Tambah Gor Berhasil!'
            ]);
        }
    }

    public function gor_edit(Gor $gor)
    {
        return view('pages.owner.data-master.gor.edit', compact('gor'));
    }

    public function gor_update(UpdateGor $request, Gor $gor)
    {
        if ($request->validated()) {
            DB::transaction(function () use ($request, $gor) {
                $gor->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'price' => $request->price,
                    'address' => $request->address
                ]);

                if ($request->hasFile('gor_image')) {
                    $gor->clearMediaCollection('gor_image');
                    $gor->addMediaFromRequest('gor_image')->toMediaCollection('gor_image');
                }
            });

            return redirect()->intended('master/gor')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Ubah Gor Berhasil!'
            ]);
        }
    }

    public function gor_update_status(Gor $gor)
    {
        DB::transaction(function () use ($gor) {
            if ($gor->status == 'active') {
                $gor->update([
                   'status' => 'inactive' 
                ]);

                Field::where('gor_id', $gor->id)
                    ->update([
                        'status' => 'inactive'
                    ]);
            } else {
                $gor->update([
                    'status' => 'active' 
                ]);

                Field::where('gor_id', $gor->id)
                    ->update([
                        'status' => 'active'
                ]);
            }
        });

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Ubah Status Gor Berhasil!'
        ]);
    }

    public function gor_destroy(Gor $gor)
    {
        DB::transaction(function () use ($gor) {
            Field::where('gor_id', $gor->id)->delete();

            $gor->delete();
        });

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Hapus Gor Berhasil!'
        ]);
    }

    public function gor_show(Gor $gor)
    {
        return view('pages.owner.data-master.gor.show', [
            'gor' => $gor,
            'fields' => Field::where('gor_id', $gor->id)->get()
        ]);

    }

    public function field_index()
    {
        return view('pages.owner.data-master.field.index', [
            'gors' => Gor::where('owner_id', auth()->user()->owner->id)->get(),
            'field_categories' => FieldCategory::where('owner_id', auth()->user()->owner->id)->get()
        ]);
    }

    public function field_create()
    {
        return view('pages.owner.data-master.field.create');
    }

    public function field_store(StoreField $request)
    {
        $owner_subscription = OwnerSubscription::where('owner_id', auth()->user()->owner->id)->first();

        if ($owner_subscription->subscription_id == 1 && Field::select('fields.*')
                                                            ->join('gors', 'fields.gor_id', '=', 'gors.id')
                                                            ->where('gors.owner_id', auth()->user()->owner->id)
                                                            ->count() == 1) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'Tambah Lapangan Hanya Dibatasi 1!'
            ]);
        }

        $time_fields = TimeField::all();

        if ($request->validated()) {
            DB::transaction(function () use ($request, $time_fields) {
                $field = Field::create([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'gor_id' => $request->gor_id,
                    'field_category_id' => $request->field_category_id,
                    'description' => $request->description
                ]);

                foreach ($time_fields as $key => $time_field) {
                    DetailField::create([
                        'field_id' => $field->id,
                        'time_field_id' => $time_field->id
                    ]);
                }

                if ($request->hasFile('field_image')) {
                    $field->addMediaFromRequest('field_image')->withResponsiveImages()->toMediaCollection('field_image');
                }
            });

            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Tambah Lapangan Berhasil!'
            ]);
        }
    }

    public function field_edit(Field $field)
    {
        return view('pages.owner.data-master.field.edit', [
            'field' => $field,
            'gors' => Gor::where('owner_id', auth()->user()->owner->id)->get(),
            'field_categories' => FieldCategory::where('owner_id', auth()->user()->owner->id)->get()
        ]);
    }

    public function field_update(UpdateField $request, Field $field)
    {
        if ($request->validated()) {
            DB::transaction(function () use ($request, $field) {
                $field->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'gor_id' => $request->gor_id,
                    'field_category_id' => $request->field_category_id,
                    'description' => $request->description
                ]);

                if ($request->hasFile('field_image')) {
                    $field->clearMediaCollection('field_image');
                    $field->addMediaFromRequest('field_image')->toMediaCollection('field_image');
                }
            });

            return redirect()->intended('master/field')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Ubah Lapangan Berhasil!'
            ]);
        }
    }

    public function field_update_status(Field $field)
    {
        DB::transaction(function () use ($field) {
            if ($field->status == 'active') {
                $field->update([
                   'status' => 'inactive' 
                ]);
            } else {
                $field->update([
                    'status' => 'active' 
                ]);
            }
        });

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Ubah Status Lapangan Berhasil!'
        ]);
    }

    public function field_destroy(Field $field)
    {
        DB::transaction(function () use ($field) {
            $field->delete();
        });

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Hapus Lapangan Berhasil!'
        ]);
    }

    public function field_show(Field $field)
    {
        return view('pages.owner.data-master.field.show', [
            'field' => $field
        ]);
    }

    public function category_index()
    {
        return view('pages.owner.data-master.category.index');
    }

    public function category_store(StoreFieldCategory $request)
    {
        if ($request->validated()) {
            DB::transaction(function () use ($request) {
                FieldCategory::create([
                    'owner_id' => auth()->user()->owner->id,
                    'name' => $request->name,
                    'slug' => Str::slug($request->name)
                ]);
            });

            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Tambah Kategori Berhasil!'
            ]);
        }
    }

    public function category_edit(FieldCategory $category)
    {
        return view('pages.owner.data-master.category.edit', [
            'category' => $category
        ]);
    }

    public function category_update(UpdateFieldCategory $request, FieldCategory $category)
    {
        if ($request->validated()) {
            DB::transaction(function () use ($request, $category) {
                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name)
                ]);
            });

            return redirect()->intended('master/category')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Ubah Kategori Lapangan Berhasil!'
            ]);
        }
    }

    public function category_show(FieldCategory $category)
    {
        return view('pages.owner.data-master.category.show', [
            'fields' => Field::where('field_category_id', $category->id)->get()
        ]);
    }

    public function category_destroy(FieldCategory $category)
    {
        DB::transaction(function () use ($category) {
            $category->delete();
        });

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Hapus Kategori Lapangan Berhasil!'
        ]);
    }
}
