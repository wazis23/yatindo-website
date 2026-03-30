<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Position;
use App\Models\Major;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::with(['position','major']);

    // 🔎 Search Nama
    if ($request->search) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // 🏫 Filter Unit
    if ($request->unit) {
        $query->where('unit', $request->unit);
    }

    // 🏷 Filter Jabatan
    if ($request->position_id) {
        $query->where('position_id', $request->position_id);
    }

    // 🏫 Filter Jurusan
    if ($request->major_id) {
        $query->where('major_id', $request->major_id);
    }

    $teachers = $query->latest()->paginate(10)->withQueryString();

    $positions = Position::all();
    $majors = Major::all();

    return view('admin.teachers.index', compact(
        'teachers',
        'positions',
        'majors'
    ));
    }
	
    public function create()
    {
        $positions = Position::where('is_active',1)->get();
        $majors    = Major::where('is_active',1)->get();

        return view('admin.teachers.create', compact('positions','majors'));
    }
	public function checkPosition(Request $request)
	{
		$position = Position::find($request->position_id);

		if (!$position || !$position->is_exclusive) {
			return response()->json(['status' => 'ok']);
		}

		$existing = Teacher::where('position_id', $position->id)->first();

		if (!$existing) {
			return response()->json(['status' => 'ok']);
		}

		return response()->json([
			'status' => 'conflict',
			'teacher' => [
				'id'    => $existing->id,
				'name'  => $existing->name,
				'photo' => $existing->photo,
				'unit'  => strtoupper($existing->unit)
			]
		]);
	}

    public function store(Request $request)
	{
		$request->validate([
			'name'         => 'required|string|max:255',
			'unit'         => 'required|in:smp,smk',
			'teacher_type' => 'required|in:umum,produktif,staff',
		]);

		$data = $request->all();

		$position = Position::find($request->position_id);

		if ($position && $position->is_exclusive) {

			$existing = Teacher::where('position_id', $position->id)->first();

			if ($existing && $request->force_replace != 1) {
				return back()
					->withErrors([
						'position_id' => 'Jabatan ini sudah digunakan oleh '.$existing->name
					])
					->withInput();
			}

			if ($existing && $request->force_replace == 1) {
				$existing->update([
					'position_id' => null
				]);
			}
		}

		if ($request->teacher_type === 'umum') {
			$data['major_id'] = null;
		}

		if ($request->teacher_type === 'staff') {
			$data['major_id'] = null;
			$data['subject']  = null;
		}

		if ($request->hasFile('photo')) {
			$data['photo'] = $request->file('photo')
				->store('teachers','public');
		}

		Teacher::create($data);

		return redirect()
			->route('admin.teachers.index')
			->with('success','Guru berhasil ditambahkan');
	}
    public function edit(Teacher $teacher)
    {
        $positions = Position::where('is_active',1)->get();
        $majors    = Major::where('is_active',1)->get();

        return view('admin.teachers.edit',
            compact('teacher','positions','majors'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required',
            'unit' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')
                ->store('teachers','public');
        }

        $teacher->update($data);

        return redirect()->route('admin.teachers.index')
            ->with('success','Guru berhasil diupdate');
    }
	
	
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return back()->with('success','Guru dihapus');
    }
}