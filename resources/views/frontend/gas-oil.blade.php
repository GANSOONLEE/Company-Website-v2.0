
@extends('frontend.layouts.app')

@section('title', ('Category'))

@section('app')

    <!-- Tab <section> -->

        <section class="mt-3">   

            <div class="border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center ml-6" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block px-4 py-3 border-b-2 rounded-t-lg" id="asian-tab" data-tabs-target="#asian" type="button" role="tab" aria-controls="asian" aria-selected="false">Asian</button>
                    </li>
                    <li role="presentation">
                        <button class="inline-block px-4 py-3 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="europe-tab" data-tabs-target="#europe" type="button" role="tab" aria-controls="europe" aria-selected="false">Europe</button>
                    </li>
                </ul>
            </div>
            <div id="default-tab-content">
                <div class="hidden px-4 py-3 rounded-lg bg-gray-50 dark:bg-gray-800 w-full" id="asian" role="tabpanel" aria-labelledby="asian-tab">
                    <!-- Asian -->
                    <iframe title="excel" class="min-w-[100%] w-auto min-h-screen shadow rounded p-2" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSscfW4_1-pcmJcm7Dx16zOm4hLWmlAzXCouvFTJ4mbWqGRxPCiU5kLoo-KRm2lelsQGYePjazyNFIa/pubhtml?widget=true&amp;headers=false"></iframe>   
                </div>
                <div class="hidden px-4 py-3 rounded-lg bg-gray-50 dark:bg-gray-800 w-full" id="europe" role="tabpanel" aria-labelledby="europe-tab">
                    <!-- Europe -->
                    <iframe title="excel" class="min-w-[100%] w-auto min-h-screen shadow rounded p-2" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vTBiK1SvgDBy6pficKyUfKboKkjh-4SlGcNCMcF8psripsX2jPvS6K7HYYbxLp_7QNZzMb85G_MpSt7/pubhtml?widget=true&amp;headers=false"></iframe> 
                </div>
            </div>

        </section>

    <!-- Tab </section> -->

@endsection