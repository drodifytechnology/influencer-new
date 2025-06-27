 @foreach ($messages as $message)
     @if ($message->user->role == 'influencer')
         <div class="chat-msg owner">
             <div class="chat-msg-profile">
                 <img class="chat-msg-img" src="{{ asset($message->attachment) }}" alt="" />
             </div>
             <div class="chat-msg-content">
                 <div class="chat-msg-text">{{ $message->message }}</div>
                 <div class="chat-msg-date">{{ \Carbon\Carbon::parse($message->created_at)->format('g:i A') }}</div>
             </div>
         </div>
     @else
         <div class="chat-msg">
             <div class="chat-msg-profile">
                 <img class="chat-msg-img" src="{{ asset($message) }}" alt="">
             </div>
             <div class="chat-msg-content">
                 <div class="chat-msg-text">{{ $message->message }}</div>
                 <div class="chat-msg-date">{{ \Carbon\Carbon::parse($message->created_at)->format('g:i A') }}</div>
             </div>
         </div>
     @endif
 @endforeach
