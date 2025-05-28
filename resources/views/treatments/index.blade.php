<table>
    <tbody>
    <tr>
        @foreach($treatments as $treatment)
            {{$treatment->name}}
            {{$treatment->dosage}}
            {{$treatment->start_at->format('d/m/Y')}}
            {{$treatment->start_at->format('d/m/Y')}}
            {{$treatment->patient->name}}
        @endforeach
    </tr>
    </tbody>
</table>
