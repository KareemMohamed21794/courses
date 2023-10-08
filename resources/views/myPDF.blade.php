<h1>{{ $title }}</h1>
<p>Date: {{ $date }}</p>
<p>Client Name: {{ $clientName }}</p>
<p>Lawyer Name: {{ $lawyerName }}</p>
<h2>List of Transactions</h2>
<ul>
    @foreach ($transactions as $transaction)
        <li>{{ $transaction }}</li>
    @endforeach
</ul>
