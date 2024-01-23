@extends('layouts.main')
@section('container')
<div class="mt-3">
    <div class="justify-content-end d-flex mb-3">
        <a href="/box/create" class="btn btn-primary"><b>Tambah Data</b></a>
    </div>
    <small class="mb-2 text-gray">Showing {{ $boxes->firstItem() . '-' . $boxes->lastItem() }} of {{ $boxes->total() > 10000 ? '10000+' : $boxes->total() }} data</small>
    <table class="table table-striped table-dark text-center">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>No. DR</th>
            <th>No. DOC</th>
            <th>Ukuran</th>
            <th>Total Set</th>
            <th>Total Poly / Total Palet</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Action</th>
        </tr>
        @php 
        $i = $boxes->firstItem();
        @endphp
        @foreach($boxes as $b)
        <tr>
            <td class="align-middle"><b>{{ $i++ }}</b></td>
            <td class="align-middle">{{ $b->title }}</td>
            <td class="align-middle">{{ $b->dr_number }}</td>
            <td class="align-middle">{{ $b->document_number }}</td>
            <td class="align-middle">{{ $b->size }}</td>
            <td class="align-middle">{{ $b->total_set }}</td>
            <td class="align-middle">{{ $b->total_poly }} POLY / {{ $b->total_palet }} PLT</td>
            @if($b->approved_by_admin == 1)
            <td class="align-middle"><div class="bg-success rounded d-flex items-center justify-content-center"><small><b>Approved By Admin</b></small></div></td>
            @elseif($b->approved_by_ppc == 1)
            <td class="align-middle"><div class="bg-warning rounded d-flex items-center justify-content-center"><small><b>Approved By PPC</b></small></div></td>
            @else
            <td class="align-middle"><div class="bg-danger rounded d-flex items-center justify-content-center"><small><b>Not Approved</b></small></div></td>
            @endif
            <td class="align-middle">{{ $b->date }}</td>
            <td class="d-flex align-middle">
                <button class="btn btn-info me-2"><i class="fa-solid fa-eye"></i></button>
                <a class="btn btn-secondary me-2" href="/box/{{ $b->id }}/edit"><i class="fa-solid fa-pen-to-square"></i></a>
                <form action="/box/{{ $b->id }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-end">
        {{ $boxes->onEachSide(3)->links() }}
    </div>
    
</div>
<style>
    small {
        font-size: 10px;
    }
</style>
@endsection