<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Position;
use App\Models\Major;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::with(['position','majors','subjects']);

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->unit) {
            $query->where('unit', $request->unit);
        }

        if ($request->position_id) {
            $query->where('position_id', $request->position_id);
        }

        if ($request->major_id) {
            $query->whereHas('majors', function ($q) use ($request) {
                $q->where('majors.id', $request->major_id);
            });
        }

        $teachers = $query->latest()->paginate(10)->withQueryString();

        $positions = Position::all();
        $majors = Major::all();

        return view('admin.teachers.index', compact('teachers','positions','majors'));
    }

    public function create()
    {
        $positions = Position::where('is_active',1)->get();
        $majors    = Major::where('is_active',1)->get();
        $subjects  = Subject::where('is_active',1)->get();

        $selectedMajors = collect();
        $selectedSubjects = collect();

        return view('admin.teachers.create', compact(
            'positions','majors','subjects','selectedMajors','selectedSubjects'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|in:smp,smk',
            'teacher_type' => 'required|in:umum,produktif,staff',
        ]);

        $data = $request->only([
            'name','nip','unit','teacher_type','position_id','is_active'
        ]);

        // =========================
        // FOTO
        // =========================
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        $teacher = Teacher::create($data);

        // =========================
        // MAPEL
        // =========================
        $subjects = $request->subject_ids ?? [];

        if ($request->teacher_type === 'staff') {
            $teacher->subjects()->detach();
        } else {
            $teacher->subjects()->sync($subjects);
        }

        // =========================
        // JURUSAN
        // =========================
        if ($request->teacher_type === 'produktif') {

            if (!$request->majors || count($request->majors) == 0) {
                return back()->withErrors([
                    'majors' => 'Minimal pilih 1 jurusan'
                ])->withInput();
            }

            $teacher->majors()->sync($request->majors);

        } else {
            $teacher->majors()->detach();
        }
        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit(Teacher $teacher)
    {
        $teacher->load(['subjects','majors']);

        $positions = Position::where('is_active',1)->get();
        $majors    = Major::where('is_active',1)->get();
        $subjects  = Subject::where('is_active',1)->get();

        return view('admin.teachers.edit', compact(
            'teacher','positions','majors','subjects'
        ));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|in:smp,smk',
            'teacher_type' => 'required|in:umum,produktif,staff',
        ]);

        $data = $request->only([
            'name','nip','unit','teacher_type','position_id','is_active'
        ]);

        // =========================
        // HAPUS FOTO (X BUTTON)
        // =========================
        if ($request->remove_photo == 1) {
            $this->deletePhoto($teacher->photo);
            $data['photo'] = null;
        }

        // =========================
        // UPLOAD FOTO BARU
        // =========================
        if ($request->hasFile('photo')) {

            $this->deletePhoto($teacher->photo);

            $data['photo'] = $request->file('photo')
                ->store('teachers', 'public');
        }

        $teacher->update($data);

        // =========================
        // MAPEL
        // =========================
        $subjects = $request->subject_ids ?? [];

        if ($request->teacher_type === 'staff') {
            $teacher->subjects()->detach();
        } else {
            $teacher->subjects()->sync($subjects);
        }

        // =========================
        // JURUSAN
        // =========================
        if ($request->teacher_type === 'produktif') {

            if (!$request->majors || count($request->majors) == 0) {
                return back()->withErrors([
                    'majors' => 'Minimal pilih 1 jurusan'
                ])->withInput();
            }

            $teacher->majors()->sync($request->majors);

        } else {
            $teacher->majors()->detach();
        }

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Guru berhasil diupdate');
    }

    public function destroy(Teacher $teacher)
    {
        $this->deletePhoto($teacher->photo);

        $teacher->delete();

        return back()->with('success','Guru dihapus');
    }

    // =========================
    // HELPER DELETE FOTO
    // =========================
    private function deletePhoto($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}