<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Config;
use App\Models\Letter;
use App\Enums\LetterType;
use App\Models\Attachment;
use App\Models\SuratMasuk;
use App\Models\Disposition;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use JetBrains\PhpStorm\NoReturn;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateConfigRequest;

class PageController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $months = range(1, 12); // 1 to 12 for each month

        $incomingAccepted = [];
        $incomingRejected = [];
        $outgoingAccepted = [];
        $outgoingRejected = [];

        foreach ($months as $month) {
            // Count for SuratMasuk
            $incomingAccepted[$month] = SuratMasuk::whereMonth('tanggal_disposisi', $month)
                ->where('status_surat', 2) // Status 2 means accepted
                ->count();

            $incomingRejected[$month] = SuratMasuk::whereMonth('tanggal_disposisi', $month)
                ->where('status_surat', 0) // Status 0 means rejected
                ->count();

            // Count for SuratKeluar
            $outgoingAccepted[$month] = SuratKeluar::whereMonth('tanggal_surat_keluar', $month)
                ->where('status_surat', 2) // Status 2 means accepted
                ->count();

            $outgoingRejected[$month] = SuratKeluar::whereMonth('tanggal_surat_keluar', $month)
                ->where('status_surat', 0) // Status 0 means rejected
                ->count();
        }

        return view('pages.dashboard', [
            'incomingAccepted' => $incomingAccepted,
            'incomingRejected' => $incomingRejected,
            'outgoingAccepted' => $outgoingAccepted,
            'outgoingRejected' => $outgoingRejected,
            'months' => $months,
        ]);
    }


    /**
     * @param Request $request
     * @return View
     */
    public function profile(Request $request): View
    {
        return view('pages.profile', [
            'data' => auth()->user(),
        ]);
    }

    /**
     * @param UpdateUserRequest $request
     * @return RedirectResponse
     */
    public function profileUpdate(UpdateUserRequest $request): RedirectResponse
    {
        try {
            $newProfile = $request->validated();
            if ($request->hasFile('profile_picture')) {
                //               DELETE OLD PICTURE
                $oldPicture = auth()->user()->profile_picture;
                if (str_contains($oldPicture, '/storage/avatars/')) {
                    $url = parse_url($oldPicture, PHP_URL_PATH);
                    Storage::delete(str_replace('/storage', 'public', $url));
                }

                //                UPLOAD NEW PICTURE
                $filename = time() .
                    '-' . $request->file('profile_picture')->getFilename() .
                    '.' . $request->file('profile_picture')->getClientOriginalExtension();
                $request->file('profile_picture')->storeAs('public/avatars', $filename);
                $newProfile['profile_picture'] = asset('storage/avatars/' . $filename);
            }
            auth()->user()->update($newProfile);
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * @return RedirectResponse
     */
    public function deactivate(): RedirectResponse
    {
        try {
            auth()->user()->update(['is_active' => false]);
            Auth::logout();
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return View
     */
    public function settings(Request $request): View
    {
        return view('pages.setting', [
            'configs' => Config::all(),
        ]);
    }

    /**
     * @param UpdateConfigRequest $request
     * @return RedirectResponse
     */
    public function settingsUpdate(UpdateConfigRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            foreach ($request->validated() as $code => $value) {
                Config::where('code', $code)->update(['value' => $value]);
            }
            DB::commit();
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            DB::rollBack();
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function removeAttachment(Request $request): RedirectResponse
    {
        try {
            $attachment = Attachment::find($request->id);
            $oldPicture = $attachment->path_url;
            if (str_contains($oldPicture, '/storage/attachments/')) {
                $url = parse_url($oldPicture, PHP_URL_PATH);
                Storage::delete(str_replace('/storage', 'public', $url));
            }
            $attachment->delete();
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
