<x-layout>
    <x-page-heading>Login</x-page-heading>

    <x-forms.form method="POST" action="/login">
        <x-forms.input name="email" label="Email" />
        <x-forms.input name="password" label="Password" type="password" />

        <x-forms.button>Log In</x-forms.button>
    </x-forms.form>
</x-layout>
