
{{-- {{$datetime}} From {{ $email }}<br><br>

Screenshot:<br>
<img src="{{ $screenshot }}" alt="">
<br><br><br>

description:
{{ $description }} <br><br>

additional:
{{ $additional }}
{{ config('app.name') }} --}}
<style>

    body{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
    }

    table{
        position: relative;
        width: 35%;
        border-collapse: collapse;
    }

    tr, table tr th, table tr td{
        border: 1px solid black;
    }

    tr.left{
        text-align: left;
    }

    tr.center{
        text-align: center;
    }

    tr.right{
        text-align: right;
    }

    .subject{
        font-size: 1.2rem;
    }

    .datetime{
        font-size: .9rem;
        color: gray;
    }

    .mb-3{
        padding-bottom: 1rem;
    }

    .mb-5{
        padding-bottom: 1.6rem;
    }

    img.logo{
        padding: 1rem 1.6rem;
        max-width: 120px;
        height: auto;
    }

</style>

<table>
    <tr class="center">
        <th>
            <img class="logo" src="{{ asset('image/logo.webp') }}" alt="">
        </th>
    </tr>
    <tr class="subject left">
        <th>BUG REPORT : {{ $email }}</th>
    </tr>
    <tr class="datetime">
        <td class="mb-5">Datetime: {{ $datetime }}</td>
    </tr>
    <tr>
        <td class="mb-3">
            Screenshot:
            <img src="{{ $message->embed($screenshot) }}" alt="">
        </td>
    </tr>
    <tr>
        <td class="mb-3">Description: {{ $description }}</td>
    </tr>
    <tr>
        <td class="mb-3">Additional: {{ $additional }}</td>
    </tr>
</table>


