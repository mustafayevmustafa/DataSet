<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessDataRequest;
use App\Jobs\ProcessData;
use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DatasetController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('datasets.index', [
            'datasets' => Dataset::byCategory($request->input('category'))
                ->byGender($request->input('gender'))
                ->byBirthDate($request->input('birthDate'))
                ->byAgeRange($request->input('min_age'), $request->input('max_age'))->paginate(10),
            'categories' => Dataset::select('category')->distinct()->get(),
        ]);
    }

    /**
     * Save the uploaded CSV file to the local storage.
     *
     * @param \Illuminate\Http\UploadedFile|null $file
     * @return string|\Illuminate\Http\RedirectResponse
     */

    private function saveUploadedFile($file)
    {
        $currentDate = Carbon::now()->format('d-m-Y');
        $fileName = $currentDate . '-' . Str::random(9) . '-datasets.csv';

        $filePath = $file->storeAs('csv_files', $fileName, 'local');

        return $filePath;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(ProcessDataRequest $request)
    {
        $csv = $request->file('csv_file');
        $filePath = $this->saveUploadedFile($csv);

        ProcessData::dispatch($filePath)->onQueue('imports');

        return redirect()->route('datasets.index')->with('success', 'Dataset imported.');
    }

    public function showImportView()
    {
        return view('datasets.import');
    }

    public function export(Request $request)
    {
        $filteredData = Dataset::byCategory($request->input('category'))
            ->byGender($request->input('gender'))
            ->byBirthDate($request->input('birthDate'))
            ->byAgeRange($request->input('min_age'), $request->input('max_age'))->get();


        $columns = [
            'category' => 'Category',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'gender' => 'Gender',
            'birthDate' => 'Birthday',
        ];

        $csvData = $this->arrayToCsv($filteredData->toArray(), $columns);

        return response($csvData)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="dataset.csv"');
    }

    private function arrayToCsv(array $array, array $columns)
    {
        $output = '';
        $header = array_values($columns);
        $output .= implode(',', $header) . "\n";

        foreach ($array as $row) {
            $rowData = [];

            foreach ($columns as $column => $label) {
                $rowData[] = isset($row[$column]) ? $row[$column] : '';
            }

            $output .= implode(',', $rowData) . "\n";
        }

        return $output;
    }
}
