<div class="mt-3 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mb-3 rounded">
    <div class="ms-3 mt-3">
        <h2> <i class="fas fa-comments"> </i> <strong> {{ trans('welcome.chat_messages') }} </strong> </h2>
    </div>

    <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-striped">
            <tbody>
                @foreach ($chat_messages as $chat_message)
                    <tr>
                        <td>
                            <div class="container">

                                <a href="#" data-toggle="popover" title="{{ $chat_message->user->name }}" data-content="{{ $chat_message->user->short_description }}">  
                                    <img src="{{ asset('storage/avatars/'.$chat_message->user->avatar ) }}?t={{ strtotime($chat_message->user->updated_at) }}" alt="Avatar" style="width:30px; height: 30px"> 
                                </a>
                                
                                <p> 
                                    @if ($chat_message->user->hasRole('staff')) 
                                        <strong style="color: green"> {{ $chat_message->user->name }}</strong>
                                     @elseif ($chat_message->user->administrator)
                                        <strong style="color: {{ $chat_message->user->administrator->rank->color }}"> {{ $chat_message->user->name }}</strong>
                                    @else 
                                        <strong style="color: black"> {{ $chat_message->user->name }}</strong>
                                    @endif: {{ $chat_message->message }} 
                                </p>
                            </div> 
                        </td>

                        <td> 
                            <div class="text-end">
                                {{ date('d/m/Y H:m', strtotime($chat_message->date)) }}  

                                @role('staff')
                                    <a class="btn btn-primary btn-sm mb-1 ms-1" title="{{ trans('chats.destroy_message') }}" onclick="destroy_chat('{{ $chat_message->id }}')"> <i class="fas fa-trash fa-sm"> </i> </a>

                                                                
                                        <form id="destroy_chat_{{ $chat_message->id }}" method="POST" action="{{ route('chats/destroy', ['id' => $chat_message->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>   
                                @endrole
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    
    <form method="POST" action="{{ route('chats/store') }}">
        @csrf

        <input class="form-control col-9 mt-3 mb-3 ms-3 float-start" type="text" placeholder="@auth {{ trans('welcome.write_your_message') }} @else {{ trans('welcome.publish_on_chat_online') }} @endauth" name="message" required @guest disabled @endguest> 
            
        <button class="btn btn-primary mt-3 me-3 mb-3 float-end" type="submit" @guest disabled @endguest>  <i class="fas fa-paper-plane fa-sm"> </i> {{ trans('welcome.publish_message') }} </button>
    </form>     

                            
</div>