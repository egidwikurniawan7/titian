@props(['variant' => 'default'])

<span {{ $attributes->class(['logo', 'logo--light' => $variant === 'light']) }}>
    <svg class="logo__mark" viewBox="0 0 44 30" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M3 22H41"/>
        <path d="M6 22C10 4 34 4 38 22"/>
        <path d="M12 22V12M22 22V9M32 22V12" stroke-width="2"/>
    </svg>
    <span class="logo__word">titian.</span>
</span>
