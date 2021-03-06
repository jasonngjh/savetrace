<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
<style>
    [x-cloak] {
        display: none;
    }
</style>

<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4" x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
                <div class="mb-5 rounded-md shadow-sm">
                    <x-jet-label for="datepicker" value="{{ __('Date of Birth') }}" />
                    <div class="relative rounded-md shadow-sm">
                        <input type="hidden" name="date" x-ref="date">
                        <x-jet-input type="text" id="dob" name="dob" :value="old('dob')" required readonly x-model="datepickerValue" @click="showDatepicker = !showDatepicker" @keydown.escape="showDatepicker = false" class="w-full pl-4 pr-10 py-3 leading-none rounded-md shadow-sm focus:outline-none focus:shadow-outline text-gray-600" placeholder="Select Date of Birth" />

                        <div class="absolute top-0 right-0 px-3 py-2">
                            <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <div class="bg-white mt-12 rounded-lg shadow p-4 absolute top-0 left-0" style="width: 17rem" x-show.transition="showDatepicker" @click.away="showDatepicker = false">

                            <div class="flex justify-between items-center mb-2">
                                <div>
                                    <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                                    <button type="button" class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1" @click="showYearpicker = !showYearpicker;" @keydown.escape="showDatepicker = false">
                                        <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                                    </button>
                                </div>
                                <div>
                                    <!-- for month date -->
                                    <button type="button" class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full" x-show="!showYearpicker" @click="month--; checkYear(); getNoOfDays()">
                                        <svg class="h-6 w-6 text-gray-500 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>
                                    <button type="button" class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full" x-show="!showYearpicker" @click="month++; checkYear(); getNoOfDays()">
                                        <svg class="h-6 w-6 text-gray-500 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                    <!-- for year -->
                                    <button type="button" class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full" x-show="showYearpicker" @click="pastDecade(); getNoOfDays()">
                                        <svg class="h-6 w-6 text-gray-500 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>
                                    <button type="button" class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full" x-show="showYearpicker" @click="nextDecade(); getNoOfDays()">
                                        <svg class="h-6 w-6 text-gray-500 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-wrap -mx-1" x-show="showYearpicker">
                                <template x-for="(yearDec, yearIndex) in decade" :key="yearIndex">
                                    <button type="button" class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1" @click="getYearValue(yearDec); getNoOfDays()">
                                        <span x-text="yearDec" class="ml-1 text-lg text-gray-600 font-normal"></span>
                                    </button>
                                </template>
                            </div>

                            <div class=" flex flex-wrap mb-3 -mx-1" x-show="!showYearpicker">
                                <template x-for="(day, index) in DAYS" :key="index">
                                    <div style="width: 14.26%" class="px-1">
                                        <div x-text="day" class="text-grey-800 font-medium text-center text-xs"></div>
                                    </div>
                                </template>
                            </div>

                            <div class="flex flex-wrap -mx-1" x-show="!showYearpicker">
                                <template x-for="blankday in blankdays">
                                    <div style="width: 14.28%" class="text-center border p-1 border-transparent text-sm"></div>
                                </template>
                                <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                                    <div style="width: 14.28%" class="px-1 mb-1">
                                        <div @click="getDateValue(date)" x-text="date" class="cursor-pointer text-center text-sm leading-none rounded-full leading-loose transition ease-in-out duration-100" :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }"></div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="contact_number" value="{{ __('Contact Number') }}" />
                <x-jet-input id="contact_number" class="block mt-1 w-full" type="text" name="contact_number" :value="old('contact_number')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('Address') }}" />
                <textarea id="address" name="address" type="text" class="block mt-1 w-full form-input rounded-md shadow-sm" required>
                {{ old('address') }}
                </textarea>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

<script>
    const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    const dateRanges = (date, rule, sum = 0) => Math.floor(date.getFullYear() / rule) * rule + sum;

    function app() {
        return {
            showDatepicker: false,
            showYearpicker: false,
            datepickerValue: '',
            decade: [],

            month: '',
            year: '',
            no_of_days: [],
            blankdays: [],
            days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

            checkYear() {
                if (this.month < 0) {
                    this.month = 11;
                    this.year--;
                }
                if (this.month > 11) {
                    this.month = 0;
                    this.year++;
                }
            },

            pastDecade() {
                currentDecade = this.decade.slice();
                this.decade.length = 0;
                const lowerDecade = dateRanges(new Date(currentDecade[0] - 1, 10, 01), 10 /** => decade**/ );
                for (var i = 0; i < 10; i++) {
                    this.decade.push(lowerDecade + i);
                }
            },

            nextDecade() {
                currentDecade = this.decade.slice();
                this.decade.length = 0;
                const lowerDecade = dateRanges(new Date(currentDecade[(currentDecade.length - 1)] + 1, 10, 01), 10 /** => decade**/ );
                for (var i = 0; i < 10; i++) {
                    this.decade.push(lowerDecade + i);
                }
            },

            initDate() {
                let today = new Date();
                this.month = today.getMonth();
                this.year = today.getFullYear();
                //this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
                var lowerDecade = dateRanges(new Date(this.year, this.month, today.getDate()), 10);
                for (var i = 0; i < 10; i++) {
                    this.decade.push(lowerDecade + i);
                }
            },

            getYearValue(year) {
                this.year = year;
                let selectedDate = new Date(this.year, this.month);
                this.datepickerValue = selectedDate.toDateString();

                this.$refs.date.value = selectedDate.getFullYear() + "-" + ('0' + selectedDate.getMonth()).slice(-2) + "-" + ('0' + selectedDate.getDate()).slice(-2);

                //console.log(this.$refs.date.value);

                this.showYearpicker = false;
            },

            isToday(date) {
                const today = new Date();
                const d = new Date(this.year, this.month, date);

                return today.toDateString() === d.toDateString() ? true : false;
            },

            getDateValue(date) {
                let selectedDate = new Date(this.year, this.month, date);
                //this.datepickerValue = selectedDate.toDateString();
                this.datepickerValue = ('0' + selectedDate.getDate()).slice(-2) + "-" + ('0' + (selectedDate.getMonth() + 1)).slice(-2) + "-" + selectedDate.getFullYear();

                this.$refs.date.value = selectedDate.getFullYear() + "-" + ('0' + selectedDate.getMonth()).slice(-2) + "-" + ('0' + selectedDate.getDate()).slice(-2);
                //console.log(this.$refs.date.value);

                this.showDatepicker = false;
            },

            getNoOfDays() {
                let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                // find where to start calendar day of week
                let dayOfWeek = new Date(this.year, this.month).getDay();
                let blankdaysArray = [];
                for (var i = 1; i <= dayOfWeek; i++) {
                    blankdaysArray.push(i);
                }

                let daysArray = [];
                for (var i = 1; i <= daysInMonth; i++) {
                    daysArray.push(i);
                }

                this.blankdays = blankdaysArray;
                this.no_of_days = daysArray;
            }
        }
    }
</script>