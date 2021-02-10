<!DOCTYPE html>
<html>

<head>
    <title>New Medical Referral Letter</title>
</head>

<body class="bg-blue-100 py-4 px-4">
    <div class="bg-white rounded-lg text-center">
        <p class="py-2">Dear Dr. {{ $referral->To_Doctor->name }}</p>
        <div class="pt-2 ">
            You have received a new referral letter sent from {{ $referral->From_Doctor->name }}, {{ $referral->From_Doctor->PracticePlace->first()->name }}.
            Log In to SaveTrace platform to view.
        </div>
    </div>
</body>

</html>