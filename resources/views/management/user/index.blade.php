@extends('layouts.main')

@section('title', 'Management - Users')

@push('styles')
<style>
   /*Dropdown carret on select input box*/
   select {
       -webkit-appearance: listbox !important;
   }
</style>
@endpush

@section('pageTitle')

<x-global.page-title page='Management' active='User Information'>
    <button style='background-color: #67BED9;' class='btn btn-sm' data-toggle="modal" data-target="#createUser">
        <span class='text-light' style='font-size: 12px'>
            <i class="bi bi-plus-circle-fill"></i> Add User
        </span>
    </button>
    <x-modals.user.create-user />
</x-global.page-title>

@endsection

@section('content')

<table class="table table-hover table-borderless" style='font-size: 12px'>
  <thead>
    <tr class='border-bottom'>
      <th scope="col">S/N</th>
      <th scope="col">NAME</th>
      <th scope="col">USERNAME</th>
      <th scope="col">E-MAIL</th>
      <th scope="col">ROLE</th>
      <th scope="col">ACTIONS</th>
    </tr>
  </thead>

    <tbody>

        @php $counter = 1; @endphp

        @foreach($users as $user)

        <tr>
          <th scope="row">{{ $counter }}</th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
          <td>

            <i type='button'
               style='color: green;padding-right: 7px'
               class="bi bi-pencil-square"
               data-toggle="modal"
               data-target="#editUser{{ $user->id }}"></i>

            <i type='button'
               style='color: red;padding-right: 7px'
               class="bi bi-trash3"
               data-toggle="modal"
               data-target="#deleteUserModal{{ $user->id }}"></i>
          </td>
        </tr>

        <x-modals.user.edit-user :user="$user" />
        <x-modals.user.delete-user :user="$user" />

        @php $counter ++; @endphp

        @endforeach


    </tbody>

    </table>

@endsection
