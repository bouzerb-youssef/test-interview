<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite('resources/css/app.css')

    </head>
    <body>
      
       
        
    <div class="container mx-auto  mt-4">
        <h1 class="text-[35px]">Liste des contacts</h1>
        <div class="flex justify-between items-center">
            <input type="text" name="first-name"  placeholder="Recherche..." class="block rounded-md py-[5px] w-[40%] mt-4  bg-[#ffffff] text-gray-800 placeholder:text-gray-400 placeholder:px-2 placeholder:text  focus:ring-2  focus:ring-inset ">
            <a href="#" class='text-white btn text-center  py-1.5 px-3.5 rounded-md '>+ Ajouter</a>
        </div>
        
        <div class="mt-4" >
            {{-- proble here check the border انشاء الله  --}}
            <table class="w-full border-t border-b-2 drop-shadow-2xl " >
                <thead class="bg-[#f4fafa]">
                    <tr  >
                        <th class="p-3 text-sm font-normal">Nom du contact</th>
                        <th class="p-3 text-sm font-normal">Société </th>
                        <th class="p-3 text-sm font-normal">Statut</th>
                        <th class="p-3 text-sm font-normal"></th>
                    </tr>

                </thead>
                <tbody class="bg-white" >
                    @foreach ($contacts as $contact)
                        <tr >
                            <td class="border-t border-b p-3 text-sm w-[40%]">{{$contact->nom}} {{$contact->prenom }}</td>
                            <td class="border-t border-b p-3 text-sm w-[40%]">{{$contact->organisation->nom}}</td>
                            <td class="border-t border-b p-3 text-sm">
                            <span 
                            
                                @if ($contact->organisation->statut =="Lead") class="px-2  bg-[#c3dcfd] rounded-lg"@endif
                                @if ($contact->organisation->statut =="Client") class="px-2  bg-[#b8edd6] rounded-lg"@endif
                                @if ($contact->organisation->statut =="Prospect") class="px-2  bg-[#fbd6ba] rounded-lg"@endif
                            >
                                {{$contact->organisation->statut}}
                            </span>
                        </td>
                            <td class="border-t border-b p-3 text-sm flex gap-2">
                            <a class="show-modal"  ><img src="{{ asset('assets/icons/eye.png') }}" class="w-[20px] hover:scale-110"    alt="Icon"></a> 
                                <a ><img src="{{ asset('assets/icons/pen.png') }}" class="w-[20px] hover:scale-110"  alt="Icon"></a>
                                <a ><img src="{{ asset('assets/icons/bin.png') }}" class="w-[20px] hover:scale-110"  alt="Icon"></a>

                            </td>
                        </tr>
                        
                    @endforeach
                    
                    
                </tbody>
            </table>
            <div class="my-4">
                {{$contacts->links()}}
            </div>
        </div>
    </div>
   {{--  <a class='text-white btn text-center  py-1.5 px-3.5 rounded-md show-modal'>+ Ajouter</a> --}}
   @include('modal')

    
       @vite('resources/js/app.js')
    </body>
</html>
