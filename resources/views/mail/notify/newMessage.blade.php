@component('mail.message')

  @component('mail::header', ['url' => route('home', [ 'forum_id' => $message->theme->forum->id ])])
    {{ $message->theme->forum->name }}
  @endcomponent

   # @lang('email.ThemeHasNewMessage.greeting')

   @lang('email.ThemeHasNewMessage.notification', ['theme' => $message->theme->name])

  @component('mail::button', ['url' => route('theme.show', ['id' => $message->theme->forum->id, 'slug' => $message->theme->slug])])
   @lang('email.ThemeHasNewMessage.look')
  @endcomponent

  @lang('email.ThemeHasNewMessage.gratitude')
  <br>
  {{ $message->theme->forum->name }}

  @component('mail::footer')
  @endcomponent

@endcomponent