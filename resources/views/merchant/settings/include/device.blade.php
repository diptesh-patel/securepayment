<div class="card">
   <div class="card-header border-bottom">
      <h4 class="card-title">Recent devices</h4>
   </div>
   <div class="card-body my-2 py-25">
      <div class="table-responsive">
         <table class="table table-bordered text-nowrap text-center">
            <thead>
               <tr>
                  <th class="text-start">BROWSER</th>
                  <th>IP ADDRESS</th>
                  <th>LOCATION</th>
                  <th>RECENT ACTIVITY</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach($devices as $device){?>    
               <tr>
                  <td class="text-start">
                     <span class="fw-bolder">{{ $device->browser_name}}</span>
                  </td>
                  <td>{{ $device->ip_address}}</td>
                  <td>{{ $device->country}}</td>
                  <td>{{ $device->created_at}}</td>
               </tr>
               <?php }?>
            </tbody>
         </table>
      </div>
   </div>
</div>