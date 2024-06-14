<?php

namespace App\Http\Controllers;

use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FormDataController extends Controller
{
    public function index()
    {
        $data = FormData::all();
        return view('index', compact('data'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:25',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'street_address' => 'required|string|max:500',
            'city' => 'required|string',
            'state' => 'required',
            'country' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $path = $request->file('profile_image')->store('profile_images', 'public');

        FormData::create([
            'profile_image' => $path,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
        ]);

        return redirect()->route('form.index')->with('success', 'Form submitted successfully');
    }

    public function edit($id)
    {
        $data = FormData::find($id);

        if (!$data) {
            return abort(404, 'Data not found.');
        }

        return view('edite', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:25',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'street_address' => 'required|string|max:500',
            'city' => 'required|string',
            'state' => 'required',
            'country' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = FormData::find($id);

        if (!$data) {
            return redirect()->route('form.index')->with('error', 'Data not found.');
        }

        if ($request->hasFile('profile_image')) {
            Storage::delete($data->profile_image);
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $data->profile_image = $path;
        }

        $data->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
        ]);

        return redirect()->route('form.index')->with('success', 'Form updated successfully');
    }

    public function destroy($id)
    {
        $data = FormData::find($id);

        if (!$data) {
            return redirect()->route('form.index')->with('error', 'Data not found.');
        }

        Storage::delete($data->profile_image);
        $data->delete();

        return redirect()->route('form.index')->with('success', 'Form deleted successfully');
    }

    public function exportCsv()
    {
        $data = FormData::all();
        $csvData = [];
        foreach ($data as $row) {
            $csvData[] = $row->toArray();
        }

        $filename = 'export.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array_keys($csvData[0]));

        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
