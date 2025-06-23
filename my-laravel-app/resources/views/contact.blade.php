@extends('layouts.base')

@section('title', 'Contact – CareerLaunch')

@section('content')
<a href="{{ url()->previous() }}" class="back-button ml-6 mt-6 inline-block text-white text-lg font-semibold hover:underline">
  ← Terug
</a>

<main class="pt-16 pb-20 px-6">
  <h1 class="text-3xl font-bold text-white text-center mb-10">Neem contact op met ons team</h1>

  <div class="grid grid-cols-1 md:grid-cols-4 gap-8 max-w-6xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
      <h2 class="text-xl font-bold text-[#1E40AF] mb-2">LIBENGE Masta</h2>
      <p class="text-gray-700 text-sm">masta.libenge@student.ehb.be</p>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
      <h2 class="text-xl font-bold text-[#1E40AF] mb-2">BEN MOHAND Nohman</h2>
      <p class="text-gray-700 text-sm">nohman.ben.mohand@student.ehb.be</p>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
      <h2 class="text-xl font-bold text-[#1E40AF] mb-2">OUANANE Omar</h2>
      <p class="text-gray-700 text-sm">omar.ouanane@student.ehb.be</p>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
      <h2 class="text-xl font-bold text-[#1E40AF] mb-2">AZANAY Yousra</h2>
      <p class="text-gray-700 text-sm">yousra.azanay@student.ehb.be</p>
    </div>
  </div>
</main>

<footer class="text-center mt-12 text-white text-sm pb-6">
  &copy; 2025 CareerLaunch – Alle rechten voorbehouden.
</footer>
@endsection
