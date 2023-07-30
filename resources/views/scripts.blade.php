{{-- search ajax for contacts  --}}
<script>
     const imageUrlDelete = '<?php echo $imageUrlDelete; ?>';
     const imageUrlEdit = '<?php echo $imageUrlEdit; ?>';
     const imageUrlView = '<?php echo $imageUrlView; ?>';
      $(document).ready(function() {
         $('#searchInput').on('input', function() {
             const query = $(this).val();
             $.ajax({
                 url: '{{route("ajax_search_contact")}}',
                 type: 'post',
                 dataType: 'json',
                 data: { q: query , "_token":"{{ csrf_token()}}"},
               
                     success: function(data) {
                         displayResults(data);
                     },
                     error: function(xhr, status, error) {
                         console.error('Error:', error);
                     }

                
                
             });
         });

         function displayResults(data) {
             const tableBody = $('#tableBody');
             tableBody.empty();

             if (data.length === 0) {
                 tableBody.append('<tr><td colspan="2">No results found</td></tr>');
             } else {
                 
                 data.data.forEach(function(contact) {
                     const row = `<tr><td class="border-t border-b p-3 text-sm w-[40%]">${contact.nom} ${contact.prenom}</td><td class="border-t border-b p-3 text-sm w-[40%]">${contact.organisation.nom}</td><td class="border-t border-b p-3 text-sm"><span${(contact.organisation.statut === 'Lead' ? ' class="px-2 bg-[#c3dcfd] rounded-lg"' : (contact.organisation.statut === 'Client' ? ' class="px-2 bg-[#b8edd6] rounded-lg"' : (contact.organisation.statut === 'Prospect' ? ' class="px-2 bg-[#fbd6ba] rounded-lg"' : '')))}>${contact.organisation.statut}</span></td><td class="border-t border-b p-3 text-sm flex gap-2"><a class="show-modal"><img src="${imageUrlView}" class="w-[20px] hover:scale-110" alt="Icon"></a><a><img src="${imageUrlEdit}" class="w-[20px] hover:scale-110" alt="Icon"></a><a><img src="${imageUrlDelete}" class="w-[20px] hover:scale-110" alt="Icon"></a></td></tr>`

                     tableBody.append(row);
                 });
             }
         }
     });
 </script>

 {{-- ajouter a contact using ajax --}}
 <script>
     
     $(document).ready(function () {
       $('#contact-form .add_contact' ).on('click',function (event) {
         event.preventDefault(); 
          //remove old error message after click on submit .
          let fieldNames =["nom" ,"prenom","email","adresse","entreprise","code_postal","ville","statut"];
          fieldNames.forEach(function(fieldName){
               $(`[name="${fieldName}"] + .error-message`).remove();
          });

         let nom =$('#nom').val();
         let prenom =$('#prenom').val();
         let email =$('#email').val();
         let adresse =$('#adresse').val();
         let entreprise =$('#entreprise').val();
         let code_postal =$('#code_postal').val();
         let ville =$('#ville').val();
         let statut =$('#statut').val();

         // Submit the form using AJAX
         $.ajax({
           url: '{{route("contacts.store")}}', 
           type: 'POST',
           data:  {nom:nom ,prenom:prenom,email:email ,adresse:adresse,entreprise:entreprise ,code_postal:code_postal,ville:ville ,statut:statut,"_token":"{{ csrf_token()}}"} ,
          
           dataType: 'json', 
           success: function (data) {
             
             console.log("gdfhsdfg here");
             
           
           },
           error: function ( error) {
               console.log(error)
               if (error.status === 422 && error.responseJSON && error.responseJSON.errors) {
                
               let errors =error.responseJSON.errors;
               
                    Object.keys(errors).forEach(function (field) {
                    const errorMessage = errors[field][0];
                    $(`[name="${field}"]`).after(`<span class="text-red-600 text-xs error-message">${errorMessage}</span>`);

               });
           }}
         });
       });
       //remove error message when you click submit button .
     

     });
   </script>