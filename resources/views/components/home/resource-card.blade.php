@props(['icon'])

<div class="col-md-4">
	 <div class="card">
		<div class="card-body">
			<div class="d-flex align-items-center">
                   <div class="mt-2">
                       {{ $slot }}
                   </div>
				<div class="mt-3 widgets-icons-2 bg-gradient-scooter text-white ms-auto"><i class="{{ $icon }}"></i>
				</div>
			</div>
		</div>
	 </div>
   </div>
