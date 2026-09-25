<footer class="bg-blue-900 text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 py-12 grid md:grid-cols-3 gap-8">

        <div>
            <h3 class="text-xl font-bold mb-4">CIOK</h3>
            <p class="text-blue-200 text-sm leading-relaxed">
                Les Ciments d'Oum El Kelil — Excellence industrielle en Tunisie depuis 1979.
            </p>
        </div>

        <div>
            <h4 class="font-semibold mb-4">{{ __('messages.contact') }}</h4>
            <ul class="text-blue-200 text-sm space-y-2">
                <li>📍 Route de Tajerouine, Le Kef, Tunisie</li>
                <li>📞 +216 78 253 816</li>
                <li>✉️ dg@ciok.com.tn</li>
            </ul>
        </div>

        <div>
            <h4 class="font-semibold mb-4">Navigation</h4>
            <ul class="text-blue-200 text-sm space-y-2">
                <li><a href="{{ route('about') }}" class="hover:text-white">{{ __('messages.about') }}</a></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-white">{{ __('messages.products') }}</a></li>
                <li><a href="{{ route('contact.show') }}" class="hover:text-white">{{ __('messages.contact') }}</a></li>
            </ul>
        </div>

    </div>
    <div class="border-t border-blue-800 text-center py-4 text-sm text-blue-300">
        © {{ date('Y') }} CIOK. {{ __('messages.all_rights_reserved') }}.
    </div>
</footer>