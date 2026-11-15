<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login · Academia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white font-sans text-slate-800 antialiased">
    <main class="min-h-screen w-full">
        <div class="relative grid min-h-screen w-full grid-cols-1 overflow-hidden bg-white lg:grid-cols-[0.88fr_1.12fr]">
            <section class="relative z-10 flex flex-col justify-center px-7 py-10 sm:px-14 sm:py-14 lg:px-16 xl:px-24">
                <a href="{{ url('/') }}" aria-label="Academia home" class="mb-14 flex w-fit items-center gap-3 sm:mb-16">
                    <svg class="h-16 w-[4.5rem] shrink-0 text-slate-800 sm:h-[4.5rem] sm:w-20" viewBox="0 0 92 76" fill="none" aria-hidden="true">
                        <path d="M8 63c14-6 27-3 37 5 11-8 25-11 40-5" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M42 61C24 52 14 37 15 16c12 9 21 21 27 39M43 57C30 42 26 24 33 6c9 13 13 28 12 46M47 53C42 34 46 17 60 3c3 17-1 33-11 47M50 53c1-17 9-31 26-41-2 17-11 30-24 42" fill="currentColor" />
                        <path d="M4 67c15-7 29-6 42 3 14-9 28-10 42-3" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" />
                    </svg>
                    <span class="block">
                        <span class="block text-[1.65rem] font-extrabold leading-none tracking-[0.12em] text-slate-800 sm:text-3xl">ACADEMIA</span>
                        <span class="mt-1.5 block text-[0.58rem] font-bold uppercase tracking-[0.11em] text-slate-600 sm:text-[0.65rem]">School Management System</span>
                    </span>
                </a>

                <div class="w-full max-w-md">
                    <div class="mb-8">
                        <p class="mb-2 text-xs font-semibold uppercase tracking-[0.18em] text-teal-600">Welcome to Academia</p>
                        <h1 class="text-2xl font-bold tracking-tight text-slate-800 sm:text-[1.8rem]">Login to your account</h1>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Enter your school account details to continue.</p>
                    </div>

                    @if (session('status'))
                        <div role="status" class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div role="alert" class="mb-5 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                            <p class="font-semibold">We couldn't log you in.</p>
                            <p class="mt-1">{{ $errors->first('student_id') ?: $errors->first('password') }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-5" onsubmit="const button = this.querySelector('[data-submit]'); button.disabled = true; button.querySelector('[data-label]').textContent = 'Logging in…'; button.querySelector('[data-spinner]').classList.remove('hidden');">
                        @csrf

                        <div>
                            <label for="student_id" class="sr-only">Student ID number</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-indigo-400" aria-hidden="true">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm0 2c-4.42 0-8 2.24-8 5v1h16v-1c0-2.76-3.58-5-8-5Z" />
                                    </svg>
                                </span>
                                <input id="student_id" name="student_id" type="text" value="{{ old('student_id') }}" autocomplete="username" required autofocus aria-invalid="{{ $errors->has('student_id') ? 'true' : 'false' }}" class="block w-full rounded-lg border border-sky-100 bg-sky-50/80 py-3.5 pl-12 pr-4 text-sm text-slate-800 outline-none transition placeholder:text-slate-500 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/20 @error('student_id') border-rose-400 focus:border-rose-500 focus:ring-rose-500/20 @enderror" placeholder="Student ID number">
                            </div>
                            @error('student_id')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="password" class="sr-only">Password</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-indigo-400" aria-hidden="true">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M17 9h-1V7a4 4 0 0 0-8 0v2H7a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2ZM10 7a2 2 0 1 1 4 0v2h-4V7Zm3 9.73V18a1 1 0 1 1-2 0v-1.27a2 2 0 1 1 2 0Z" />
                                    </svg>
                                </span>
                                <input id="password" name="password" type="password" autocomplete="current-password" required aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}" class="block w-full rounded-lg border border-sky-100 bg-sky-50/80 py-3.5 pl-12 pr-12 text-sm text-slate-800 outline-none transition placeholder:text-slate-500 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/20 @error('password') border-rose-400 focus:border-rose-500 focus:ring-rose-500/20 @enderror" placeholder="Password">
                                <button type="button" data-password-toggle aria-label="Show password" aria-pressed="false" class="absolute inset-y-0 right-0 flex items-center rounded-r-lg px-4 text-slate-400 transition hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                    <svg data-eye class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.5-6 9.75-6 9.75 6 9.75 6-3.5 6-9.75 6-9.75-6-9.75-6Z" /><circle cx="12" cy="12" r="2.75" /></svg>
                                    <svg data-eye-off class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m3 3 18 18M10.6 6.2A10.8 10.8 0 0 1 12 6c6.25 0 9.75 6 9.75 6a16 16 0 0 1-3.1 3.6M6.2 6.2C3.7 7.8 2.25 12 2.25 12s3.5 6 9.75 6a10.4 10.4 0 0 0 3.2-.5" /><path stroke-linecap="round" stroke-linejoin="round" d="M9.9 9.9a3 3 0 0 0 4.2 4.2" /></svg>
                                </button>
                            </div>
                            @error('password')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center justify-between gap-4 pt-0.5">
                            <label for="remember" class="inline-flex cursor-pointer items-center gap-2.5 text-sm text-slate-600">
                                <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-indigo-700 focus:ring-2 focus:ring-indigo-600/30">
                                <span>Remember me</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-medium text-slate-700 transition hover:text-indigo-700">Forgot password?</a>
                            @endif
                        </div>

                        <button type="submit" data-submit class="inline-flex min-w-28 items-center justify-center gap-2 rounded-lg bg-[#173b5c] px-7 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#102f4b] focus:outline-none focus:ring-2 focus:ring-[#173b5c] focus:ring-offset-2 disabled:cursor-wait disabled:opacity-75">
                            <svg data-spinner class="hidden h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" /><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8v4a4 4 0 0 0-4 4H4Z" /></svg>
                            <span data-label>Login</span>
                        </button>
                    </form>

                    <p class="mt-9 text-xs leading-5 text-slate-400">© {{ date('Y') }} Academia School Management System</p>
                </div>
            </section>

            <aside class="relative hidden overflow-hidden bg-[#e8f3f9] lg:block" aria-label="Students learning together">
                <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-br from-[#eef7fb] via-[#e7f2f8] to-[#dcecf5]"></div>
                <div aria-hidden="true" class="absolute -right-20 -top-24 h-80 w-80 rounded-full bg-white/45 blur-3xl"></div>
                <svg class="absolute left-0 top-0 h-full w-56" viewBox="0 0 220 800" preserveAspectRatio="none" aria-hidden="true">
                    <path d="M0 0h212c-8 98-37 174-72 257C90 362 78 503 0 800V0Z" fill="white" />
                </svg>

                <div class="absolute inset-0 flex items-center justify-center p-8 pl-20 xl:p-12 xl:pl-24">
                    <svg class="relative z-10 h-auto w-full max-w-[760px]" viewBox="0 0 820 650" fill="none" role="img" aria-label="Colorful books and students studying">
                        <!-- small floating accents -->
                        <path d="m182 144 8 15 8-15-8-15-8 15ZM655 91l7 13 7-13-7-13-7 13ZM718 280l8 15 8-15-8-15-8 15Z" fill="#F25382" />
                        <path d="m314 82 7 13 7-13-7-13-7 13ZM775 184l6 11 6-11-6-11-6 11Z" fill="#F7B23D" />
                        <path d="m105 276 7 13 7-13-7-13-7 13ZM583 128l7 13 7-13-7-13-7 13Z" fill="#06B9B1" />

                        <!-- leafy plant -->
                        <path d="M301 462c28-94 38-170 37-259" stroke="#0AAE9D" stroke-width="8" stroke-linecap="round" />
                        <path d="M334 291c-44-8-71-35-75-77 40 5 67 30 75 77ZM331 350c-42-1-71-22-83-61 40-1 70 19 83 61ZM331 404c-38 8-70-6-92-40 37-10 68 3 92 40ZM338 263c31-32 38-67 20-106-31 25-39 61-20 106ZM335 333c35-27 47-61 35-102-34 20-48 55-35 102Z" fill="#08B9AE" />
                        <path d="M276 459h53l-8 57h-37l-8-57Z" fill="#F25382" />

                        <!-- tilted folder and papers -->
                        <g transform="rotate(-16 282 292)">
                            <path d="M165 176h112l25 24h105v235H165V176Z" fill="#F5A92F" />
                            <path d="M165 200h242v235H165V200Z" fill="#FFBC49" />
                            <path d="M194 229h163v42H194z" fill="#EFA735" opacity=".7" />
                        </g>
                        <g transform="rotate(-8 451 237)">
                            <path d="M372 159h117l35 35v115H372V159Z" fill="#F8FCFE" />
                            <path d="M489 159v37h35" fill="#D7EAF3" />
                            <path d="M395 215h91M395 239h102M395 263h76" stroke="#7795A8" stroke-width="5" stroke-linecap="round" />
                        </g>

                        <!-- bottom ground -->
                        <path d="M142 548h584" stroke="#A8CFDA" stroke-width="7" stroke-linecap="round" />

                        <!-- bottom book -->
                        <path d="M201 481h438c16 0 28 12 28 27v43H229c-16 0-28-12-28-27v-43Z" fill="#F9B83E" />
                        <path d="M230 487h139c19 0 31 13 31 31v33H231c-16 0-28-12-28-28v-8c0-16 11-28 27-28Z" fill="#DFF3F8" />
                        <path d="M393 487h246c16 0 28 12 28 28v9c0 15-12 27-28 27H393v-64Z" fill="#EFAE34" />

                        <!-- middle book -->
                        <path d="M158 394h492c17 0 30 13 30 30v43H187c-16 0-29-13-29-29v-44Z" fill="#08BDB3" />
                        <path d="M187 400h187c18 0 31 13 31 31v36H188c-16 0-29-13-29-29v-9c0-16 12-29 28-29Z" fill="#DDF2F7" />
                        <path d="M406 400h244c17 0 30 13 30 29v9c0 16-13 29-30 29H406v-67Z" fill="#16B4AA" />

                        <!-- top book -->
                        <path d="M232 320h433c18 0 31 13 31 30v43H262c-17 0-30-13-30-30v-43Z" fill="#F25382" />
                        <path d="M261 326h165c17 0 30 13 30 30v37H262c-17 0-30-13-30-30v-7c0-17 12-30 29-30Z" fill="#E6F4F8" />
                        <path d="M477 326h188c18 0 31 13 31 30v7c0 17-13 30-31 30H477v-67Z" fill="#F4B43B" />
                        <path d="M447 326h13v67h-13zM463 326h13v67h-13z" fill="#E4A632" />

                        <!-- seated student, lower left -->
                        <path d="m278 526-4 39 18 1 13-40M324 525l9 40 18-3-3-43" fill="#08B8AD" />
                        <path d="m274 559-12 10c-3 3-1 8 4 8h26l-2-10-10-8ZM333 559l-2 15h25c5 0 6-5 2-8l-12-9-13 2Z" fill="#12385B" />
                        <path d="M270 421c6-14 17-21 34-20l24 4c12 2 20 12 20 24v45l-52 10-31-17 5-46Z" fill="#F25382" />
                        <path d="M269 434 244 472l31 9 23-32M341 433l17 26-18 11-17-20" fill="#F4A77C" />
                        <path d="M269 478h78v16h-78z" fill="#173A5D" />
                        <path d="M282 382c0-17 12-30 29-30 16 0 28 13 28 30v16c0 14-12 25-28 25-17 0-29-11-29-25v-16Z" fill="#F6B18A" />
                        <path d="M280 385c-5-19 5-39 25-43 21-4 38 9 39 30l-10-7-10-14c-9 12-23 19-42 18l-2 16Z" fill="#12385B" />
                        <path d="M297 385h2M321 385h2" stroke="#173A5D" stroke-width="4" stroke-linecap="round" />
                        <path d="M302 400c5 4 10 4 15 0" stroke="#CE745C" stroke-width="3" stroke-linecap="round" />

                        <!-- laptop for lower student -->
                        <path d="m336 443 70-1 13 41h-71l-12-40Z" fill="#102E54" />
                        <path d="m338 484 90-1-9 7h-75l-6-6Z" fill="#193E67" />
                        <circle cx="376" cy="463" r="3" fill="#D7EAF3" />

                        <!-- seated student on upper right -->
                        <path d="m569 297 6 34-15 2-12-36M626 298l-2 35 15 1 7-37" fill="#F7B23D" />
                        <path d="m568 326-12 8c-4 3-2 8 3 8h22l-1-9-12-7ZM630 328l-1 14h23c5 0 6-5 2-8l-11-7-13 1Z" fill="#173A5D" />
                        <path d="M564 223c4-17 17-25 35-23l27 4c13 2 21 13 20 26l-3 46-68 8-15-22 4-39Z" fill="#08BDB3" />
                        <path d="m574 238-19 25 19 13 13-25M642 239l17 25-17 10-15-24" fill="#F6B18A" />
                        <path d="M582 183c0-18 13-31 31-31s31 13 31 31v17c0 16-13 28-31 28s-31-12-31-28v-17Z" fill="#F6B18A" />
                        <path d="M579 185c-8-20 3-42 22-48 20-7 42 4 47 24l-5 24-9-11-8-18c-9 13-22 20-42 20l-5 17-5-8 5 0Z" fill="#F25382" />
                        <path d="M600 188h2M626 188h2" stroke="#173A5D" stroke-width="4" stroke-linecap="round" />
                        <path d="M605 203c5 4 10 4 15 0" stroke="#CE745C" stroke-width="3" stroke-linecap="round" />
                        <path d="m612 226 14 3 11-4-1 14-14 5-11-7 1-11Z" fill="#F6B18A" />

                        <!-- laptop for upper student -->
                        <path d="m602 247 88-4-7 45-84 3 3-44Z" fill="#112F57" />
                        <path d="m599 290 93-3-9 7h-77l-7-4Z" fill="#1C456F" />
                        <circle cx="647" cy="267" r="3" fill="#E2F1F5" />

                        <!-- pink reading lamp -->
                        <path d="M689 497c6-20 23-34 45-39l63-13c14-3 27 6 30 20l5 18-133 37-10-23Z" fill="#F25382" />
                        <path d="m696 519 131-36 9 27-133 37-7-28Z" fill="#F25382" />
                        <path d="M729 530h90v20h-90z" fill="#EC4779" />
                        <path d="M744 512h19v20h-19z" fill="#D63C70" />
                        <circle cx="752" cy="513" r="10" fill="#D93E71" />
                    </svg>
                </div>
            </aside>
        </div>
    </main>

    <script>
        document.querySelector('[data-password-toggle]').addEventListener('click', function () {
            const password = document.getElementById('password');
            const showing = password.type === 'password';
            password.type = showing ? 'text' : 'password';
            this.setAttribute('aria-pressed', String(showing));
            this.setAttribute('aria-label', showing ? 'Hide password' : 'Show password');
            this.querySelector('[data-eye]').classList.toggle('hidden', showing);
            this.querySelector('[data-eye-off]').classList.toggle('hidden', !showing);
        });
    </script>
</body>
</html>
