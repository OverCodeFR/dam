<x-layouts.app :title="__('Patients')">
    <table>
        <tbody>
            @foreach($patients as $patient)
                <tr>
                    <td>
                        {{$patient}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.app>
