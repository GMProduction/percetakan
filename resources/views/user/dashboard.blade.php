@extends('user.base')
@section('title')
Dashboard
@endsection
@section('content')

    <section class="m-2">


        <div class="table-container">

            <h5 class="mb-3">Events</h5>
    
                <table class="table table-striped table-bordered ">
                    <thead>
                        <th>
                            #
                        </th>
                        <th>
                           Event Name
                        </th>
                        <th>
                           Date
                        </th>
                        <th>
                           Payment Slip
                        </th>
    
                        <th>
                            Action
                        </th>

                    </thead>
    
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            Dubafest
                        </td>
                        <td>
                            21 August 2021 - 24 August 2021
                        </td>
                        <td>
                            @php($status = "waiting")   
                            <span 
                            @if($status = "waiting")
                            class="t-orange"
                            @elseif($status = "accepted")
                            class="t-green"
                            @else
                            class="t-red"
                            @endif
                            >
                            
                            Waiting
                            </span>
                        </td>
                      

                        <td>
                            <button type="button" class="btn btn-primary btn-sm">Detail</button>
                        </td>
                    </tr>
    
                </table>
    
            </div>

    </section>
   

@endsection

@section('script')


@endsection
