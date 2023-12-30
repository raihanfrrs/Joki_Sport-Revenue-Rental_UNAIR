<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Gor;
use App\Models\Owner;
use App\Models\OwnerSubscription;
use App\Models\Renter;
use App\Models\SubscriptionTransaction;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
