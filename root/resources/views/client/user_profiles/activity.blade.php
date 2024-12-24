@extends('client.user_profiles.profiles')
@section('proFiles')
    <div class="w-full p-6 bg-white overflow-x-auto">
        @if ($activities->isNotEmpty())
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-6 py-4 border-b text-left">{{ __('content.activity.title') }}</th>
                        <th class="px-6 py-4 border-b text-left">{{ __('content.activity.description') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activitie)
                        @php
                            $properties = json_decode($activitie->properties, true);
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b text-gray-800">{{ $properties['title'] ?? 'Không có tiêu đề' }}
                            </td>
                            <td class="px-6 py-4 border-b text-gray-800">{{ $activitie->description ?? 'ád' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="w-full flex justify-between items-center p-2">{{ $activities->links('admin.layouts.pagination') }}
            </div>
        @endif
    </div>
@endsection
