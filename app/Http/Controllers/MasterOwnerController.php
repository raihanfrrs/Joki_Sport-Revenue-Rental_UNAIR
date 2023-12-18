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
use App\Http\Requests\UpdateGor;

class MasterOwnerController extends Controller
{
    public function renter_index()
    {
        return view('pages.owner.data-master.renter.index');
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
        if ($request->validated()) {
            DB::transaction(function () use ($request) {
                $gor = Gor::create([
                    'owner_id' => auth()->user()->owner->id,
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'price' => $request->price,
                    'type_duration' => $request->type_duration,
                    'address' => $request->address,
                    'standard' => $request->standard
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
                    'gor_id' => $request->gor_id,
                    'field_category_id' => $request->field_category_id,
                    'address' => $request->address,
                    'standard' => $request->standard
                ]);

                if ($request->hasFile('gor_image')) {
                    $gor->clearMediaCollection('gor_image');
                    $gor->addMediaFromRequest('gor_image')->toMediaCollection('gor_image');
                }
            });

            return redirect()->back()->with([
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
        return view('pages.owner.data-master.field.index');
    }

    public function field_create()
    {
        return view('pages.owner.data-master.field.create', [
            'gors' => Gor::where('owner_id', auth()->user()->owner->id)->get(),
            'field_categories' => FieldCategory::where('owner_id', auth()->user()->owner->id)->get()
        ]);
    }

    public function field_store(StoreField $request)
    {
        if ($request->validated()) {
            DB::transaction(function () use ($request) {
                $field = Field::create([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'gor_id' => $request->gor_id,
                    'field_category_id' => $request->field_category_id,
                    'description' => $request->description
                ]);

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
}
