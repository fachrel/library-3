<!DOCTYPE html>
<html lang="en" class="bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Printout</title>
    <link rel="stylesheet" href="{{asset('Midone/Compiled/dist/css/app.css')}}" />

    <script>
        window.onload = () => {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container mx-auto p-5">
        <h1 class="text-2xl font-bold mb-5">Loan Printout</h1>

        <table class="min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Invoice</th>
                    <th class="border px-4 py-2">User ID</th>
                    <th class="border px-4 py-2">Borrowed At</th>
                    <th class="border px-4 py-2">Must Return By</th>
                    <th class="border px-4 py-2">Book Title</th>
                    <th class="border px-4 py-2">Author</th>
                    <th class="border px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    @php
                        $totalBooks = $loan->loanDetails->count();
                    @endphp
                    <tr>
                        <td class="border px-4 py-2" rowspan="{{ $totalBooks }}">{{ $loan->invoice }}</td>
                        <td class="border px-4 py-2" rowspan="{{ $totalBooks }}">{{ $loan->user->username }}</td>
                        <td class="border px-4 py-2" rowspan="{{ $totalBooks }}">{{ \Carbon\Carbon::parse($loan->borrowed_at)->format('d F Y') }}</td>
                        <td class="border px-4 py-2" rowspan="{{ $totalBooks }}">{{ \Carbon\Carbon::parse($loan->must_returned_at)->format('d F Y') }}</td>

                        <td class="border px-4 py-2">{{ $loan->loanDetails[0]->book->name }}</td>
                        <td class="border px-4 py-2">{{ $loan->loanDetails[0]->book->author }}</td>
                        <td class="border px-4 py-2">{{ $loan->loanDetails[0]->status }}</td>
                    </tr>

                    @for ($i = 1; $i < $totalBooks; $i++)
                        <tr>
                            <td class="border px-4 py-2">{{ $loan->loanDetails[$i]->book->name }}</td>
                            <td class="border px-4 py-2">{{ $loan->loanDetails[$i]->book->author }}</td>
                            <td class="border px-4 py-2">{{ $loan->loanDetails[$i]->status }}</td>
                        </tr>
                    @endfor

                    {{-- <tr>
                        <td class="border px-4 py-2" colspan="7">Total Books: {{ $totalBooks }}</td>
                    </tr> --}}
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
