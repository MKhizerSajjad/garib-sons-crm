<?php
use Carbon\Carbon;
use App\Models\Setting;use App\Models\{
    PurchaseOrder,
    ArrivalInspection,
    ArrivalGatePass,
    ArrivalWeighbridge
};

function statusReturn($prefix, $statuses, $status = null, $type = null)
{
    if(isset($statuses[$prefix])) {
        $statusArray = $statuses[$prefix];

        return isset($statusArray[$status])
            ? ($type === 'badge' ? $statusArray[$status][1] : $statusArray[$status][0])
            : ($type === 'badge' ? array_column($statusArray, 1) : array_column($statusArray, 0));

    } else {
        return 'Unknown'; // Or handle the case when $prefix is not found in $statuses
    }
}

function getGenStatus($prefix, $status = null, $type = null)
{
    $statuses = [
        'general'=> [
            '1' => ['Active', '<span class="badge bg-primary">Active</span>'],
            '2' => ['Inactive', '<span class="badge bg-warning">Inactive</span>']
        ],
        'user'=> [
            '1' => ['Active', '<span class="badge bg-primary">Active</span>'],
            '2' => ['Inactive', '<span class="badge bg-warning">Inactive</span>'],
            '3' => ['Suspended', '<span class="badge bg-danger">Suspended</span>']
        ],
        'service'=> [
            '1' => ['Prioritized', '<span class="badge bg-success">Prioritized</span>'],
            '2' => ['Active', '<span class="badge bg-primary">Active</span>'],
            '3' => ['Inactive', '<span class="badge bg-warning">Inactive</span>'],
        ],
        'bool'=> [
            '1' => ['Yes', '<span class="badge bg-primary">Yes</span>'],
            '2' => ['No', '<span class="badge bg-warning">No</span>']
        ],
        'acceptance'=> [
            '1' => ['Accept', '<span class="badge bg-success">Accept</span>'],
            '2' => ['Reject', '<span class="badge bg-danger">Reject</span>']
        ]
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}

function getUsertype($prefix, $status = null, $type = null)
{
    $statuses = [
        'all'=> [
            '1' => ['Admin', '<span class="badge bg-info">Admin</span>'],
            '2' => ['Manager', '<span class="badge bg-warning">Manager</span>'],
            '3' => ['Technician', '<span class="badge bg-secondary">Technician</span>'],
            '4' => ['Customer', '<span class="badge bg-success">Customer</span>']
        ]
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}

function getStockStatus($prefix, $status = null, $type = null)
{
    $statuses = [
        'general'=> [
            '1' => ['In Stock', '<span class="badge bg-primary">In Stock</span>'],
            '2' => ['Low stock', '<span class="badge bg-warning">Low stock</span>'],
            '3' => ['Out of Stock', '<span class="badge bg-danger">Out of Stock</span>'],
            '4' => ['Reordered', '<span class="badge bg-info">Reordered</span>']
        ],
        'woocommerce'=> [
            'instock' => ['Instock', '<span class="badge bg-primary">Instock</span>'],
            'outofstock' => ['Out of Stock', '<span class="badge bg-danger">Out of Stock</span>'],
            'onbackorder' => ['On Back Order', '<span class="badge bg-info">On Back Order</span>'],
        ]
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}

function getPayment($prefix, $status = null, $type = null)
{
    $statuses = [
        'status'=> [
            '1' => ['Paid', '<span class="badge bg-success font-size-18"> Paid</span>'],
            '2' => ['Partially Paid', '<span class="badge bg-primary font-size-18"> Partially Paid</span>'],
            '3' => ['Pending', '<span class="badge bg-warning font-size-18"> Pending</span>'],
            '4' => ['Unpaid', '<span class="badge bg-danger font-size-18"> Unpaid</span>']
        ],
        'via'=> [
            '1' => ['Cash', '<span class="badge bg-primary">Cash</span>'],
            '2' => ['Check', '<span class="badge bg-danger">Check</span>'],
            '3' => ['Bank Transfer', '<span class="badge bg-info">Bank Transfer</span>'],
            '4' => ['Card', '<span class="badge bg-info">Card</span>'],
            '5' => ['Stripe', '<span class="badge bg-info">Stripe</span>'],
        ],
        'term'=> [
            '1' => ['3 Days', '<span class="badge bg-primary">3 Days</span>'],
            '2' => ['10 Days', '<span class="badge bg-danger">10 Days</span>'],
            '3' => ['15 Days', '<span class="badge bg-info">15 Days</span>'],
            '4' => ['30 Days', '<span class="badge bg-info">30 Days</span>'],
        ]
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}

function getCaseStatus($prefix, $status = null, $type = null)
{
    $statuses = [
        'general'=> [
            '1' => ['To Recieve', '<span class="badge bg-primary">To Recieve</span>'],
            '2' => ['Recieved', '<span class="badge bg-warning">Recieved</span>'],
            '3' => ['Inspecting', '<span class="badge bg-danger">Inspecting</span>'],
            '4' => ['Update Faults', '<span class="badge bg-info">Update Faults</span>'],
            '5' => ['Work In Progress', '<span class="badge bg-info">Work In Progress</span>'],
            '6' => ['Completed', '<span class="badge bg-info">Completed</span>'],
            '7' => ['Ready To Dispatch', '<span class="badge bg-info">Ready To Dispatch</span>'],
            '8' => ['Dispatched', '<span class="badge bg-info">Dispatched</span>'],
            '9' => ['Delivered', '<span class="badge bg-info">Delivered</span>'],
        ],
        'woocommerce'=> [
            'instock' => ['Instock', '<span class="badge bg-primary">Instock</span>'],
            'outofstock' => ['Out of Stock', '<span class="badge bg-danger">Out of Stock</span>'],
            'onbackorder' => ['On Back Order', '<span class="badge bg-info">On Back Order</span>'],
        ]
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}

function getService($prefix, $status = null, $type = null)
{
    $statuses = [
        'location'=> [
            '1' => ['Deliver to office', '<span class="badge bg-primary">Deliver to office</span>'],
            '2' => ['I will send to office', '<span class="badge bg-warning">I will send to office</span>'],
            '3' => ['Invite engineer to my home', '<span class="badge bg-danger">Invite engineer to my home</span>'],
        ],
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}

function getDocument($prefix, $status = null, $type = null)
{
    $statuses = [
        'types'=> [
            '1' => ['picture', '<span class="badge bg-primary">picture</span>'],
            '2' => ['passpord', '<span class="badge bg-warning">passpord</span>'],
            '3' => ['result card', '<span class="badge bg-danger">result card</span>'],
            '4' => ['id card', '<span class="badge bg-danger">id card</span>'],
        ],
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}

function getFields($prefix, $status = null, $type = null)
{
    $statuses = [
        'types'=> [
            '1' => ['text', '<span class="badge bg-primary">text</span>'],
            '2' => ['number', '<span class="badge bg-warning">number</span>'],
            '3' => ['phone', '<span class="badge bg-danger">phone</span>'],
            '4' => ['email', '<span class="badge bg-danger">email</span>'],
            '5' => ['textarea', '<span class="badge bg-danger">textarea</span>'],
        ],
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}

function getDelivery($prefix, $status = null, $type = null)
{
    $statuses = [
        'mode'=> [
            '1' => ['Traller', '<span class="badge bg-success">Traller</span>'],
            '2' => ['Truck', '<span class="badge bg-primary">Truck</span>'],
            '3' => ['Bag', '<span class="badge bg-warning">Bag</span>'],
            '4' => ['Katta', '<span class="badge bg-secondary">Katta</span>'],
            '5' => ['KG', '<span class="badge bg-info">KG</span>'],
        ],
        'term'=> [
            '1' => ['FOB', '<span class="badge bg-success">FOB</span>'],
            '2' => ['C&F', '<span class="badge bg-primary">C&F</span>'],
        ],
        'quality' => [
            '1' => ['Foreign Matter', '<span class="badge bg-danger">Foreign Matter</span>'],
            '2' => ['Immature / Shrivelled', '<span class="badge bg-warning">Immature / Shrivelled</span>'],
            '3' => ['Paddy', '<span class="badge bg-success">Paddy</span>'],
            '4' => ['Damaged / Discolor', '<span class="badge bg-danger">Damaged / Discolor</span>'],
            '5' => ['Broken', '<span class="badge bg-primary">Broken</span>'],
            '6' => ['Green Grains', '<span class="badge bg-info">Green Grains</span>'],
            '7' => ['Yellow / Amber Grains', '<span class="badge bg-warning">Yellow / Amber Grains</span>'],
            '8' => ['Red Grains', '<span class="badge bg-danger">Red Grains</span>'],
            '9' => ['Moisture', '<span class="badge bg-light">Moisture</span>'],
            '10' => ['Average Grain Length', '<span class="badge bg-secondary">Average Grain Length</span>'],
            '11' => ['Pecks', '<span class="badge bg-info">Pecks</span>'],
            '12' => ['Chalky Grains', '<span class="badge bg-warning">Chalky Grains</span>'],
            '13' => ['Purity C/V', '<span class="badge bg-success">Purity C/V</span>'],
            '14' => ['Aflatoxin', '<span class="badge bg-danger">Aflatoxin</span>'],
            '15' => ['Chobba', '<span class="badge bg-secondary">Chobba</span>'],
            '16' => ['Look', '<span class="badge bg-light">Look</span>'],
        ],
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}
function calculateDelivery($mode = null, $quantity = null, $type = 'min') {
    $results = [
        'min_traller' => 0,
        'min_truck' => 0,
        'min_bag' => 0,
        'min_katta' => 0,
        'min_kg' => 0,
        'max_traller' => 0,
        'max_truck' => 0,
        'max_bag' => 0,
        'max_katta' => 0,
        'max_kg' => 0,
    ];

    // Define conversion factors for min and max
    $conversionFactors = [
        'min' => [
            'traller' => [0.00004, 0.00008, 0.01, 0.02],
            'truck' => [0.002, 0.004, 0.5, 50],
            'bag' => [0.004, 0.008, 2, 100],
            'katta' => [0.5, 125, 250, 12500],
            'kg' => [2, 250, 500, 25000],
        ],
        'max' => [
            'traller' => [2, 320, 640, 32000],
            'truck' => [0.5, 160, 320, 16000],
            'bag' => [0.003125, 0.00625, 2, 100],
            'katta' => [0.0015625, 0.003125, 0.5, 50],
            'kg' => [0.00003125, 0.0000625, 0.01, 0.02],
        ],
    ];

    // Select the appropriate conversion factors based on the type
    $factors = $conversionFactors[$type];

    // Map mode to corresponding keys
    $modeMapping = [
        '1' => 'traller',
        '2' => 'truck',
        '3' => 'bag',
        '4' => 'katta',
        '5' => 'kg',
    ];

    // Check if mode is valid
    if (isset($modeMapping[$mode]) && !is_null($quantity) && is_numeric($quantity) && $quantity > 0) {
        $key = $modeMapping[$mode];

        // Calculate results based on the selected mode and quantity
        $results['max_' . $key] = $quantity * $factors[$key][3]; // For max
        // foreach ($modeMapping as $m => $k) {
        //     if ($k !== $key) {
        //         $results['max_' . $k] = $quantity / $factors[$key][array_search($k, array_keys($modeMapping))];
        //     }
        // }
    }

    return $results;
}
function getBroker($prefix, $status = null, $type = null)
{
    $statuses = [
        'term'=> [
            '1' => ['Immediate', '<span class="badge bg-success">Immediate</span>'],
            '2' => ['Delay', '<span class="badge bg-primary">Delay</span>'],
        ],
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}

function getReturn($prefix, $status = null, $type = null)
{
    $statuses = [
        'types'=> [
            '1' => ['Replacement', '<span class="badge bg-success">Replacement</span>'],
            '2' => ['Replaceable', '<span class="badge bg-primary">Replaceable</span>'],
            '3' => ['Non Replaceable', '<span class="badge bg-primary">Non Replaceable</span>'],
        ],
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}

function getShifts($prefix, $status = null, $type = null)
{
    $statuses = [
        'types'=> [
            '1' => ['Morning', '<span class="badge bg-primary">Morning</span>'],
            '2' => ['Evening', '<span class="badge bg-warning">Evening</span>'],
            '3' => ['Weekend', '<span class="badge bg-secondary">Weekend</span>'],
        ],
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}

function getDeduction($prefix, $status = null, $type = null)
{
    $statuses = [
        'types'=> [
            '1' => ['Mositure', '<span class="badge bg-primary">Mositure</span>'],
            '2' => ['Damage', '<span class="badge bg-warning">Damage</span>'],
            '3' => ['Chalky', '<span class="badge bg-secondary">Chalky</span>'],
            '4' => ['Damage', '<span class="badge bg-secondary">Damage</span>'],
        ],
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}

function getInspection($prefix, $status = null, $type = null)
{
    $statuses = [
        'types'=> [
            'first' => [1, '<span class="badge bg-primary">First</span>'],
            'second' => [2, '<span class="badge bg-warning">Second</span>'],
            'final' => [3, '<span class="badge bg-secondary">Final</span>'],
        ],
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}

// ************************* OTHERS ************************
function getFileTypeFromExtension($extension) {
    // Define arrays for different file types
    $imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
    $videoExtensions = ['mp4', 'avi', 'mov', 'mkv'];
    $documentExtensions = ['doc', 'docx', 'pdf', 'txt', 'xls', 'xlsx', 'ppt', 'pptx'];
    // Add more arrays as needed for other file types

    // Convert extension to lowercase for case-insensitive comparison
    $lowercaseExtension = strtolower($extension);

    // Check if the extension belongs to images
    if (in_array($lowercaseExtension, $imageExtensions)) {
        return '1'; // Return 'image' for images
    }
    // Check if the extension belongs to videos
    elseif (in_array($lowercaseExtension, $videoExtensions)) {
        return '2'; // Return 'video' for videos
    }
    // Check if the extension belongs to documents/files
    elseif (in_array($lowercaseExtension, $documentExtensions)) {
        return '3'; // Return 'document' for documents/files
    }
    else {
        return '0'; // Default type or handle other types as needed
    }
}

function getTax() {
    $tax = Setting::where('type', 'tax')->pluck('data')->first();
    return json_decode($tax)[0]->percentage;
}

function numberFormat($amount, $type=null) {
    $formatted = number_format($amount, 2, '.', ',');

    switch ($type) {
        case 'pkr':
            return $formatted . '';
        case 'percentage':
            return $formatted . '%';
        default:
            return $formatted;
    }
}

function generateCode($type, $prefix, $season = null, $format = 'full') {

    $season = !empty($season) ? getSeason($season, $format) : '';
    $code = $prefix . '-' . $season;
    if($type == 'po') {
        $todaysCount = PurchaseOrder::where('code', 'LIKE', $code.'%')->count();
    } elseif($type == 'inspection') {
        $todaysCount = ArrivalInspection::where('code', 'LIKE', $code.'%')->count();
    } elseif($type == 'passin') {
        $todaysCount = ArrivalGatePass::where('code', 'LIKE', $code.'%')->where('count', 1)->count();
    } elseif($type == 'weighbridge') {
        $todaysCount = ArrivalWeighbridge::where('code', 'LIKE', $code.'%')->count();
    } else {
        return 'Invalid';
    }
    // Increment the max code number by 1, if null set it to 1
    return $code. str_pad(++$todaysCount, 5, '0', STR_PAD_LEFT);
}


function getSeason($year = null, $format = 'full')
{
    // If no year is provided, use the current year
    if (is_null($year)) {
        $year = date('Y');
    }

    // Convert two-digit year to four-digit year if necessary
    if (is_numeric($year) && strlen($year) == 4) {
        $startYear = intval($year);
    } elseif (is_numeric($year) && strlen($year) == 2) {
        $currentYear = date('Y');
        $currentYearPrefix = intval(substr($currentYear, 0, 2)); // 0, 4
        $yearPrefix = intval($year / 100);

        // Determine if the two-digit year belongs to the current century or next century
        if ($yearPrefix < $currentYearPrefix) {
            $startYear = $currentYearPrefix * 100 + $year;
        } else {
            $startYear = ($currentYearPrefix - 1) * 100 + $year;
        }
    } else {
        return 'Invalid year';
    }

    // Ensure the year is valid
    if ($startYear < 1000 || $startYear > 9999) {
        return 'Invalid year';
    }

    $endYear = $startYear + 1;
    $endYearFormatted = substr($endYear, -2);

    return $format === 'short'
        ? substr($startYear, -2) . $endYearFormatted
        : "{$startYear}-{$endYearFormatted}";
}

function numberToWords($num)
{
    if ($num === 0) return "zero";

    $units = ["", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine"];
    $teens = ["", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen"];
    $tens = ["", "ten", "twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninety"];
    $thousands = ["", "thousand", "million", "billion", "trillion"];

    function convertBelowThousand($n)
    {
        global $units, $teens, $tens;

        $word = "";

        if ($n >= 100) {
            $word .= $units[floor($n / 100)] . " hundred ";
            $n %= 100;
        }

        if ($n >= 20) {
            $word .= $tens[floor($n / 10)] . " ";
            $n %= 10;
        }

        if ($n >= 11 && $n <= 19) {
            $word .= $teens[$n - 10] . " ";
            $n = 0;
        }

        if ($n > 0) {
            $word .= $units[$n] . " ";
        }

        return $word;
    }

    $words = "";
    $chunkCount = 0;

    while ($num > 0) {
        $chunk = $num % 1000;
        if ($chunk > 0) {
            $words = convertBelowThousand($chunk) . ($thousands[$chunkCount] ? " " . $thousands[$chunkCount] : "") . " " . $words;
        }
        $num = floor($num / 1000);
        $chunkCount++;
    }

    return trim($words);
}
