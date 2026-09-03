@extends('layouts.master')

@section('content')
<main class="min-h-screen bg-slate-50 py-12"><div class="mx-auto max-w-4xl px-4"><div class="rounded-3xl bg-white p-6 shadow-xl sm:p-10"><p class="text-sm font-black uppercase tracking-wider text-emerald-600">Legal</p><h1 class="mt-2 text-3xl font-black text-slate-950">Terms of Service</h1><div class="prose prose-slate mt-8 max-w-none whitespace-pre-line leading-8">{!! $content ?: '<p>Terms of Service content will be published here.</p>' !!}</div></div></div></main>
@endsection
