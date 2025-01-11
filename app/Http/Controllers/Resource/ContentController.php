<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\UpdateOrderRequest;
use App\Models\Content;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContentController extends Controller
{
    public function orderEdit(Content $content)
    {
        $availableOrders = Content::where('material_id', $content->material_id)
            ->get()
            ->pluck('order')
            ->toArray();

        $script = '
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const modalElement = document.getElementById("reorderModal");
                const modal = new coreui.Modal(modalElement);
                modal.show();
            });
        </script>
        ';

        return redirect()->back()->with([
            'content' => $content,
            'availableOrders' => $availableOrders,
            'script' => $script,
        ]);
    }

    public function orderUpdate(UpdateOrderRequest $request, Content $content)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $currentOrder = $content->order;

            $content->update([
                'order' => 0,
            ]);

            Content::where('material_id', $content->material_id)
                ->where('order', $validatedData['to'])
                ->first()
                ->update([
                    'order' => $currentOrder,
                ]);

            $content->update([
                'order' => $validatedData['to'],
            ]);

            DB::commit();

            session()->flash('success', __('Urutan konten berhasil diperbarui'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Gagal memperbarui urutan konten'));

            return redirect()->back();
        }
    }
}
