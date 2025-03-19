<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            <!-- Right-aligned navigation -->
            <div class="space-x-4">
                <a href="{{ route('kendaraan.index') }}"
                    class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Kendaraan</a>
                <a href="{{ route('pelanggan.index') }}"
                    class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Pelanggan</a>
                <a href="{{ route('riwayat.index') }}"
                    class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Riwayat</a>
                <a href="{{ route('jasa_servis.index') }}"
                    class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Jasa Servis</a>
                <a href="{{ route('sparepart.index') }}"
                    class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Sparepart</a>
            </div>
        </div>
    </x-slot>