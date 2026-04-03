<footer class="w-full border-t border-primary/10 bg-[#0e0e0e] font-body text-xs uppercase tracking-widest">
    <div class="mx-auto max-w-7xl px-8 py-12 flex flex-col md:flex-row justify-between items-center gap-6">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="/logo.png" alt="GearHub Logo" class="h-8 w-auto"/>
            <span class="font-black text-sm" style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;">GearHub</span>
        </a>
        <div class="flex gap-8">
            <a class="text-on-surface-variant hover:text-primary transition-colors" href="#">Privacy Policy</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors" href="#">Terms of Service</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors" href="#">Shipping</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors" href="#">Returns</a>
        </div>
        <p class="text-on-surface-variant normal-case tracking-normal text-[11px]">&copy; {{ date('Y') }} GearHub. All rights reserved.</p>
    </div>
</footer>
