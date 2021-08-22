<div class="mt-2 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mb-3">
    <div class="ml-3 mt-3">
        <h2> <i class="fas fa-comments"> </i> <strong> {{ trans('welcome.chat_messages') }} </strong> </h2>
    </div>

    <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-striped">
            <tbody>
                @foreach ($chat_messages as $chat_message)
                    <tr>
                        <td>
                            <div class="container">
                                <img src="{{ asset('storage/avatars/'.$chat_message->user->avatar ) }}" alt="Avatar" style="width:30px; height: 30px">
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
                            <div class="float-right">
                                {{ date('d/m/Y H:m', strtotime($chat_message->date)) }}  

                                @role('staff')
                                    <a class="btn btn-info btn-sm mb-1 ml-1" title="{{ trans('administrators.destroy_administrator') }}" onclick="destroy_chat('{{ $chat_message->id }}')"> <i class="fas fa-trash fa-sm"> </i> </a>

                                                                
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

        <input class="form-control col-9 mt-3 mb-3 ml-3 float-left" type="text" placeholder="{{ trans('welcome.write_your_message') }}" name="message" required> 
 
        <button class="btn btn-info mt-3 mr-3 mb-3 float-right" type="submit">  <i class="fas fa-paper-plane fa-sm"> </i> {{ trans('welcome.publish_message') }} </button>
    </form> 
                            
</div>