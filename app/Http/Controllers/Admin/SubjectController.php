<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Major;

class SubjectController extends Controller
{
    
        public function index(Request $request)
        {
            $query = Subject::with('major');

            // 🔍 FILTER SEARCH (PARTIAL)
            if ($request->search && $request->filter) {

                $search = $request->search;

                if ($request->filter === 'name') {
                    $query->where('name', 'like', '%' . $search . '%');
                }

                if ($request->filter === 'unit') {
                    $query->where('unit', 'like', '%' . $search . '%');
                }

                if ($request->filter === 'type') {
                    $query->where('type', 'like', '%' . $search . '%');
                }

                if ($request->filter === 'major') {
                    $query->whereHas('major', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
                }
            }

            // 🔽 SORTING 
            if ($request->sort_by && $request->sort_dir) {

                if ($request->sort_by === 'major') {
                    $query->leftJoin('majors', 'subjects.major_id', '=', 'majors.id')
                        ->orderBy('majors.name', $request->sort_dir)
                        ->select('subjects.*');
                } else {
                    $query->orderBy($request->sort_by, $request->sort_dir);
                }
            } else {
                $query->latest();
            }

            $subjects = $query->get();

            return view('admin.subjects.index', compact('subjects'));
        }

        public function create()
        {
            $majors = Major::all();
            return view('admin.subjects.create', compact('majors'));
        }

        public function store(Request $request)
        {
            $data = $request->validate([
                'name' => 'required',
                'type' => 'required',
                'unit' => 'required|in:smp,smk',
                'major_id' => 'nullable'
            ]);

            // 🔥 LOGIC UTAMA
            if ($data['unit'] === 'smp') {
                $data['major_id'] = null;
            }

            Subject::create($data);

            return redirect()->route('admin.subjects.index')
                ->with('success','Mapel berhasil ditambahkan');
        }

        public function edit(Subject $subject)
        {
            $majors = Major::all();
            return view('admin.subjects.edit', compact('subject','majors'));
        }

        public function update(Request $request, Subject $subject)
        {
            $data = $request->validate([
                'name' => 'required',
                'type' => 'required',
                'unit' => 'required|in:smp,smk',
                'major_id' => 'nullable'
            ]);

            if ($data['unit'] === 'smp') {
                $data['major_id'] = null;
            }

            $subject->update($data);

            return redirect()->route('admin.subjects.index')
                ->with('success','Mapel berhasil diupdate');
        }

        public function destroy(Subject $subject)
        {
            $subject->delete();

            return back()->with('success','Mapel dihapus');
        }
}

