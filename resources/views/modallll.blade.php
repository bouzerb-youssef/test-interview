<tr >
    <td class="border-t border-b p-3 text-sm w-[40%]">contact.nom contact.prenom </td>
    <td class="border-t border-b p-3 text-sm w-[40%]">contact.organisation.nom</td>
    <td class="border-t border-b p-3 text-sm">
    <span 
    
        @if (contact.organisation.statut =="Lead") class="px-2  bg-[#c3dcfd] rounded-lg"@endif
        @if (contact.organisation.statut =="Client") class="px-2  bg-[#b8edd6] rounded-lg"@endif
        @if (contact.organisation.statut =="Prospect") class="px-2  bg-[#fbd6ba] rounded-lg"@endif
    >
        contact.organisation.statut
    </span>
</td>
    <td class="border-t border-b p-3 text-sm flex gap-2">
    <a class="show-modal"  ><img src=" asset('assets/icons/eye.png') " class="w-[20px] hover:scale-110"    alt="Icon"></a> 
        <a ><img src=" asset('assets/icons/pen.png') " class="w-[20px] hover:scale-110"  alt="Icon"></a>
        <a ><img src=" asset('assets/icons/bin.png') " class="w-[20px] hover:scale-110"  alt="Icon"></a>

    </td>
</tr>