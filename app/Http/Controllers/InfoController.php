<?php

namespace App\Http\Controllers;

use App\Http\Resources\InfoResource;
use App\Models\Info;
use Illuminate\Http\Request;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\SaveWebPageTest;
class InfoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request['perPage'];
            $data = Info::orderByDesc('id')->orderByDesc('id')->paginate($perPage);
            $pages_count = ceil($data->total() / $perPage);
            $labels = [];
            for ($i = 1; $i <= $pages_count; $i++) {
                (array_push($labels, $i));
            }
            return response([
                "data" => InfoResource::collection($data),
                "pages" => $pages_count,
                "total" => $data->total(),
                "labels" => $labels,
                "title" => 'insights',
                "tooltip_new" => 'ثبت insight جدید',
            ], 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function store(Request $request)
    {
        try {
            $info = Info::create($request->all());
            return \response($info,201);

        }catch (\Exception $exception){ return $exception; }
    }

    public function show(string $id)
    {
        try {
            $info = Info::find($id);
            return \response($info,200);

        }catch (\Exception $exception){ return $exception; }
    }
    public function update(Request $request, string $id)
    {
        try {
            $info = Info::find($id);
            $info->update($request->all());
            return \response($info,200);

        }catch (\Exception $exception){ return $exception; }
    }

    public function destroy(string $id)
    {
        try {
            $info = Info::find($id);
            $info->delete();
            return \response('deleted successfully',200);

        }catch (\Exception $exception){ return $exception; }
    }

    public function test()
    {
        (new SaveWebPageTest('chrome'))->index();
    }
}
