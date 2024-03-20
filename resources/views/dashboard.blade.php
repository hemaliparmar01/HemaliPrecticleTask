<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="p-6 text-gray-900 text-sm dark:text-gray-100 w-full text-center">
                    <thead class="border-2 bg-[#f9fafb] h-10 rounded-lg">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Loan amount</th>
                            <th>Terms (In days)</th>
                            <th>Next Payment date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                            <tr class="h-9 border-2 border-slate-100">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $loan->user['name'] }}</td>
                                <td>{{ $loan->amount }}</td>
                                <td>{{ $loan->terms }}</td>
                                <td>
                                    {{ $loan->status == 1 ? $loan->next_payment_date : '--' }}
                                </td>
                                <td>
                                    @if ($loan->status)
                                        <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Approved</span>
                                    @else
                                    <div class="container mx-auto px-4 h-full mt-1">
                                        <div class="flex items-center justify-center h-full w-full">
                                          <div class="relative mb-2 flex items-center">
                                            <select loan-id="{{ $loan->id }}" required class="loan_status text-black/70 bg-white px-1 py-1 transition-all cursor-pointer border border-gray-200 rounded-lg appearance-none focus:border-gray-200 focus:ring-gray-50 invalid:text-black/70 w-48">
                                                <option value="" disabled selected>Pending</option>
                                                <option value="1">Approved</option>
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
