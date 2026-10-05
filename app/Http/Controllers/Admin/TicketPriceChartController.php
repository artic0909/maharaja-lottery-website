<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class TicketPriceChartController extends Controller
{
    /**
     * Path to persistent JSON storage.
     */
    protected function getStoragePath(): string
    {
        return storage_path('app/ticket_charts.json');
    }

    /**
     * Default 3 Categories defined by User:
     * 1. Maharaja 500 - Rs.40 - Code: MH784563
     * 2. Rajshree 200 - Rs.149 - Code: RM352164
     * 3. Rajshree 50 - Rs.249 - Code: VM754238
     */
    protected function getDefaultCharts(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Maharaja 500',
                'slug' => 'maharaja_500',
                'price' => 'Rs. 40',
                'price_num' => 40,
                'code' => 'MH784563',
                'series' => 'MH',
                'number_range' => '100000 - 999999',
                'display' => 50,
                'position' => 'LB 1',
                'prizes' => [
                    ['label' => '1st', 'amount' => 'INR 50 Lakhs', 'winners' => '1 Lucky Ticket'],
                    ['label' => '2nd', 'amount' => 'INR 10 Lakhs', 'winners' => '5 winners'],
                    ['label' => '3rd', 'amount' => 'INR 2 Lakhs', 'winners' => '10 winners'],
                    ['label' => '4th', 'amount' => 'INR 5,000', 'winners' => '20 winners'],
                ],
                'status' => 'Active',
            ],
            [
                'id' => 2,
                'name' => 'Rajshree 200',
                'slug' => 'rajshree_200',
                'price' => 'Rs. 149',
                'price_num' => 149,
                'code' => 'RM352164',
                'series' => 'RM',
                'number_range' => '100000 - 999999',
                'display' => 50,
                'position' => 'LB 2',
                'prizes' => [
                    ['label' => '1st', 'amount' => 'INR 25 Lakhs', 'winners' => '1 Lucky Ticket'],
                    ['label' => '2nd', 'amount' => 'INR 5 Lakhs', 'winners' => '5 winners'],
                    ['label' => '3rd', 'amount' => 'INR 1 Lakh', 'winners' => '10 winners'],
                    ['label' => '4th', 'amount' => 'INR 2,000', 'winners' => '20 winners'],
                ],
                'status' => 'Active',
            ],
            [
                'id' => 3,
                'name' => 'Rajshree 50',
                'slug' => 'rajshree_50',
                'price' => 'Rs. 249',
                'price_num' => 249,
                'code' => 'VM754238',
                'series' => 'VM',
                'number_range' => '100000 - 999999',
                'display' => 50,
                'position' => 'LB 3',
                'prizes' => [
                    ['label' => '1st', 'amount' => 'INR 10 Lakhs', 'winners' => '1 Lucky Ticket'],
                    ['label' => '2nd', 'amount' => 'INR 2 Lakhs', 'winners' => '5 winners'],
                    ['label' => '3rd', 'amount' => 'INR 50,000', 'winners' => '10 winners'],
                    ['label' => '4th', 'amount' => 'INR 1,000', 'winners' => '20 winners'],
                ],
                'status' => 'Active',
            ],
        ];
    }

    /**
     * Retrieve all ticket price charts.
     */
    public function getCharts(): array
    {
        $path = $this->getStoragePath();
        if (File::exists($path)) {
            $content = json_decode(File::get($path), true);
            if (is_array($content) && count($content) > 0) {
                return $content;
            }
        }

        $defaults = $this->getDefaultCharts();
        $this->saveCharts($defaults);
        return $defaults;
    }

    /**
     * Save ticket price charts to storage.
     */
    protected function saveCharts(array $charts): void
    {
        $dir = dirname($this->getStoragePath());
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }
        File::put($this->getStoragePath(), json_encode($charts, JSON_PRETTY_PRINT));
    }

    /**
     * Display the ticket price chart creation & management page.
     */
    public function index(): View
    {
        $ticketCharts = $this->getCharts();
        return view('admin.tickets.index', compact('ticketCharts'));
    }

    /**
     * Store or update a ticket price chart dynamically.
     */
    public function store(Request $request)
    {
        $request->validate([
            'draw_name' => 'required|string|max:255',
            'price' => 'required|string|max:100',
        ]);

        $charts = $this->getCharts();
        $id = $request->input('id');

        // Parse price number
        $priceStr = $request->input('price');
        preg_match('/\d+/', $priceStr, $priceMatch);
        $priceNum = !empty($priceMatch) ? (int)$priceMatch[0] : 40;

        // Parse series code
        $series = strtoupper(trim($request->input('series_prefixes', 'MH')));
        $sampleCode = $request->input('ticket_code');
        if (empty($sampleCode)) {
            $firstSeries = explode(',', $series)[0] ?? 'MH';
            $sampleCode = trim($firstSeries) . rand(100000, 999999);
        }

        // Build prizes array
        $prizeAmounts = $request->input('prize_amount', []);
        $prizeWinners = $request->input('prize_winners', []);
        $prizes = [];

        foreach ($prizeAmounts as $idx => $amount) {
            if (!empty(trim($amount))) {
                $prizes[] = [
                    'label' => $this->getOrdinal($idx + 1),
                    'amount' => trim($amount),
                    'winners' => $prizeWinners[$idx] ?? '1 Lucky Ticket',
                ];
            }
        }

        if (empty($prizes)) {
            $prizes = [
                ['label' => '1st', 'amount' => 'INR 50 Lakhs', 'winners' => '1 Lucky Ticket'],
                ['label' => '2nd', 'amount' => 'INR 10 Lakhs', 'winners' => '5 winners'],
                ['label' => '3rd', 'amount' => 'INR 2 Lakhs', 'winners' => '10 winners'],
            ];
        }

        $chartData = [
            'id' => $id ? (int)$id : (count($charts) > 0 ? max(array_column($charts, 'id')) + 1 : 1),
            'name' => $request->input('draw_name'),
            'slug' => strtolower(preg_replace('/[^A-Za-z0-9_]/', '_', $request->input('draw_name'))),
            'price' => $priceStr,
            'price_num' => $priceNum,
            'code' => $sampleCode,
            'series' => $series,
            'number_range' => ($request->input('start_number', '100000') ?: '100000') . ' - ' . ($request->input('end_number', '999999') ?: '999999'),
            'display' => (int)($request->input('display_limit', 50) ?: 50),
            'position' => $request->input('position', 'LB 1') ?: 'LB 1',
            'prizes' => $prizes,
            'status' => $request->has('is_active') ? 'Active' : 'Inactive',
        ];

        if ($id) {
            // Update existing
            $found = false;
            foreach ($charts as $key => $item) {
                if ($item['id'] == $id) {
                    $charts[$key] = $chartData;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $charts[] = $chartData;
            }
        } else {
            // Add new
            $charts[] = $chartData;
        }

        $this->saveCharts($charts);

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket category "' . $chartData['name'] . '" saved dynamically!');
    }

    /**
     * Delete a ticket price chart.
     */
    public function destroy($id)
    {
        $charts = $this->getCharts();
        $filtered = array_values(array_filter($charts, function ($item) use ($id) {
            return $item['id'] != $id;
        }));

        $this->saveCharts($filtered);

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket category removed successfully.');
    }

    /**
     * Helper for ordinals.
     */
    private function getOrdinal(int $number): string
    {
        $ends = ['th','st','nd','rd','th','th','th','th','th','th'];
        if ((($number % 100) >= 11) && (($number % 100) <= 13)) {
            return $number . 'th';
        }
        return $number . $ends[$number % 10];
    }
}
