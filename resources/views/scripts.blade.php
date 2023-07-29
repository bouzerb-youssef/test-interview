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
     // Wait for the DOM to be ready
     $(document).ready(function () {
       // Add a submit event listener to the form
       $('#contact-form').on('submit', function (event) {
         event.preventDefault(); // Prevent the default form submission
   
         // Serialize the form data
         const formData = $(this).serialize();
         
         // Submit the form using AJAX
         $.ajax({
           url: '{{route("contacts.store")}}', // Form action URL
           type: 'POST',
           data: { formData: formData , "_token":"{{ csrf_token()}}"},
           dataType: 'json', // Expected response type (change to 'html' if the server responds with HTML)
           success: function (data) {
             // Handle the response here, if needed
             console.log(data);
             // For example, you can redirect to a new page after successful submission:
           
           },
           error: function (xhr, status, error) {

               console.log("here");
             console.error('Error:', error);
             // Handle errors, display them, etc.
           }
         });
       });
     });
   </script>