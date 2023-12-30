<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFieldMaster;
use App\Http\Requests\UpdateGorMaster;
use App\Http\Requests\UpdateOwnerMaster;
use App\Models\Gor;
use App\Models\User;
use App\Models\Field;
use App\Models\Owner;
use App\Models\Renter;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OwnerSubscription;
use Illuminate\Support\Facades\DB;
use App\Models\SubscriptionTransaction;
use App\Http\Requests\UpdateRenterMaster;
use App\Models\FieldCategory;

class MasterAdminController extends Controller
{
    public function renter_index()
    {
        return view('pages.admin.data-master.renter.index');
    }

    public function renter_update_status(Renter $renter)
    {
        DB::transaction(function () use ($renter) {
            if ($renter->status == 'active') {
                $renter->update([
                   'status' => 'inactive' 
                ]);
            } else {
                $renter->update([
                    'status' => 'active' 
                ]);
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

    public function renter_show(Renter $renter)
    {
        return view('pages.admin.data-master.renter.show', compact('renter'));
    }

    public function renter_update(UpdateRenterMaster $request, Renter $renter)
    {
        if ($request->validated()) {
            $renter->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'phone' => $request->phone
            ]);

            $renter->user->update([
                'email' => $request->email
            ]);

            return redirect()->intended('data-master/renter')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Ubah Identitas Penyewa Berhasil!'
            ]);
        }
    }

    public function renter_destroy(Renter $renter)
    {
        $transactions = Transaction::where('renter_id', $renter->id);

        foreach ($transactions->get() as $key => $transaction) {
            $transaction->detail_transaction->delete();
        }

        $transactions->delete();
        User::whereId($renter->user_id)->delete();
        $renter->delete();

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Hapus Data Penyewa Berhasil!'
        ]);
    }

    public function renter_update_password(Request $request, Renter $renter)
    {
        $renter->user->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Ubah Kata Sandi Penyewa Berhasil!'
        ]);
    }

    public function owner_index()
    {
        return view('pages.admin.data-master.owner.index');
    }

    public function owner_update_status(Owner $owner)
    {
        DB::transaction(function () use ($owner) {
            if ($owner->status == 'active') {
                $owner->update([
                   'status' => 'inactive' 
                ]);
            } else {
                $owner->update([
                    'status' => 'active' 
                ]);
            }
        });

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Ubah Status Pemilik Berhasil!'
        ]);
    }

    public function owner_show(Owner $owner)
    {
        return view('pages.admin.data-master.owner.show', compact('owner'));
    }

    public function owner_update(UpdateOwnerMaster $request, Owner $owner)
    {
        if ($request->validated()) {
            $owner->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'phone' => $request->phone
            ]);

            $owner->user->update([
                'email' => $request->email
            ]);

            return redirect()->intended('data-master/owner')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Ubah Identitas Pemilik Berhasil!'
            ]);
        }
    }

    public function owner_destroy(Owner $owner)
    {
        $gors = Gor::where('owner_id', $owner->id);

        foreach ($gors->get() as $key => $gor) {
            Field::where('gor_id', $gor->id)->delete();
        }

        $gors->delete();
        OwnerSubscription::where('owner_id', $owner->id)->delete();
        SubscriptionTransaction::where('owner_id', $owner->id)->delete();
        $owner->delete();

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Hapus Data Pemilik Berhasil!'
        ]);
    }

    public function owner_update_password(Request $request, Owner $owner)
    {
        $owner->user->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Ubah Kata Sandi Pemilik Berhasil!'
        ]);
    }

    public function gor_index()
    {
        return view('pages.admin.data-master.gor.index');
    }

    public function gor_update_status(Gor $gor)
    {
        DB::transaction(function () use ($gor) {
            if ($gor->status == 'active') {
                $gor->update([
                   'status' => 'inactive' 
                ]);

                Field::where('gor_id', $gor->id)->update([
                    'status' => 'inactive'
                ]);
            } else {
                $gor->update([
                    'status' => 'active' 
                ]);

                Field::where('gor_id', $gor->id)->update([
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

    public function gor_edit(Gor $gor)
    {
        return view('pages.admin.data-master.gor.edit', compact('gor'));
    }

    public function gor_show(Gor $gor)
    {
        return view('pages.admin.data-master.gor.show', [
            'gor' => $gor,
            'fields' => Field::where('gor_id', $gor->id)->get()
        ]);
    }

    public function gor_update(UpdateGorMaster $request, Gor $gor)
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

            return redirect()->intended('data-master/gor')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Ubah Gor Berhasil!'
            ]);
        }
    }

    public function gor_destroy(Gor $gor)
    {
        Field::where('gor_id', $gor->id)->delete();
        $transaction = Transaction::where('gor_id', $gor->id);

        foreach ($transaction->get() as $key => $transaction) {
            $transaction->detail_transaction->delete();
        }

        $transaction->delete();
        $gor->delete();

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Hapus Data Gor Berhasil!'
        ]);
    }

    public function field_index()
    {
        return view('pages.admin.data-master.field.index');
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

    public function field_edit(Field $field)
    {
        return view('pages.admin.data-master.field.edit', [
            'field' => $field,
            'gors' => Gor::all(),
            'field_categories' => FieldCategory::all()
        ]);
    }

    public function field_show(Field $field)
    {
        return view('pages.admin.data-master.field.show', [
            'field' => $field
        ]);
    }

    public function field_update(UpdateFieldMaster $request, Field $field)
    {

    }

    public function field_destroy(Field $field)
    {
        $gor = Gor::whereId($field->gor_id)->first();

        $transaction = Transaction::where('gor_id', $gor->id);

        foreach ($transaction->get() as $key => $transaction) {
            $transaction->detail_transaction->delete();
        }

        $transaction->delete();
        $field->delete();

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Hapus Data Lapangan Berhasil!'
        ]);
    }
}
