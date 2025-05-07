<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\LegalDocument;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'representante_legal' => 'required|string|max:255',
            'documentos_legales.*' => 'file|mimes:pdf',
        ]);

        \Log::info('Archivos recibidos:', ['files' => $request->file('documentos_legales')]);

        $company = Company::create($validated);

        if ($request->hasFile('documentos_legales')) {
            $files = $request->file('documentos_legales');
            $names = $request->input('documentos_nombres', []);

            foreach (array_values($files) as $key => $file) {
                $customName = $names[$key] ?? null;
                $fileName = $customName ? $customName . '.' . $file->getClientOriginalExtension() : $file->getClientOriginalName();
                $path = 'storage/' . $file->storeAs('documentos_legales', $fileName, 'public');

                \Log::info('Subiendo archivo:', ['key' => $key, 'name' => $fileName, 'path' => $path]);

                LegalDocument::create([
                    'company_id' => $company->id,
                    'file_path' => $path,
                    'file_name' => $customName,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Empresa creada exitosamente.');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'representante_legal' => 'required|string|max:255',
            'documentos_legales' => 'nullable|file|mimes:pdf,jpg',
        ]);

        if ($request->hasFile('documentos_legales')) {
            $validated['documentos_legales'] = $request->file('documentos_legales')->store('documentos_legales', 'public');
        }

        $company->update($validated);

        return redirect()->route('companies.index')->with('success', 'Empresa actualizada exitosamente.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->back()->with('success', 'Empresa eliminada exitosamente.');
    }

    public function deleteDocument(LegalDocument $document)
    {
        $document->delete();
        return redirect()->back()->with('success', 'Documento eliminado exitosamente.');
    }
}