<style>
    .custom--flex-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px; /* Adjust as needed */
    }

    .custom--flex-item {
        border: 1px solid #ccc;
        padding: 15px;
        text-align: center;
    }

    .table-game img {
        width: 100%;
        max-width: 150px; /* Set a fixed width for the image */
        height: auto;
        border-radius: 5px; /* Rounded corners for the thumbnail effect */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow for the thumbnail effect */
        margin-bottom: 10px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-outline--base {
        background-color: transparent;
        color: #3490dc;
        border: 1px solid #3490dc;
        padding: 5px 10px;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
        cursor: pointer;
        border-radius: 4px;
    }

    @media (max-width: 768px) {
        .custom--flex-container {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        }
    }

    @media (max-width: 576px) {
        .custom--flex-container {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="table-responsive--md">
    <div class="custom--flex-container">
        @forelse($phases as $phase)
            <div class="custom--flex-item  feature-card rounded-3">
                <div class="table-game">
                    <img class="thumbnail mx-auto" src="{{ getImage(getFilePath('lottery') . '/' . @$phase->lottery->image, getFileSize('lottery')) }}" alt="image">
                   
                </div>
                 <h2 class="name">{{ __($phase->lottery->name) }}</h2>
                <p><strong>@lang('Start Date'):</strong> {{ @showDateTime($phase->start_date, 'Y-m-d') }}</p>
                <p><strong>@lang('Draw Date'):</strong> {{ @showDateTime($phase->draw_date, 'Y-m-d') }}</p>
                <p><strong>@lang('Price'):</strong> {{ showAmount($phase->lottery->price) }} {{ $general->cur_text }}</p>
                <div class="progress lottery--progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ ($phase->sold / $phase->quantity) * 100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($phase->sold / $phase->quantity) * 100 }}%"></div>
                </div>
                <span class="fs--14px">{{ getAmount(($phase->sold / $phase->quantity) * 100) }}%</span>
                <div class="status-badge">
                    @php  echo $phase->DrawBadge; @endphp
                </div>
                <a class="btn btn-sm btn-outline--base" href="@if (request()->routeIs('user.*')) {{ route('user.lottery.details', $phase->id) }} @else {{ route('lottery.details', $phase->id) }} @endif">
                    @if (@request()->routeIs('user.home'))
                        @lang('Play Now')
                    @else
                        @lang('Buy Ticket')
                    @endif
                </a>
            </div>
        @empty
            <p class="text-center">{{ __($emptyMessage) }}</p>
        @endforelse
    </div>
</div>
