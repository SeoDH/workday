<?php

namespace App\Http\Controllers;

use App\Exceptions\api\ApiRequestException;
use App\Models\ApiResult;
use Illuminate\Http\Request;
use Log;
use Carbon\Carbon;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * workday controller
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiRequestException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getWorkdays(Request $request)
    {
        // param 유효성체크
        $this->validate($request, [
            'start' => 'required|date',
            'end' => 'required|date',
            'week' => 'integer',
        ]);

        $input = $request->only(['start', 'end', 'week']);
        $start = Carbon::createFromFormat('Y-m-d', $input['start']);
        $end = Carbon::createFromFormat('Y-m-d', $input['end']);
        if ($start > $end) {
            throw new ApiRequestException("시작일이 종료일보다 클 수 없습니다.");
        }

        $apiResult = new ApiResult();
        $apiResult->days = $this->countWorkday($start, $end, $input);

        return response()->json($apiResult);
    }

    /**
     * 월~금요일인지 체크.
     *
     * @param $day
     * @return bool
     */
    public function isWorkday($day): bool
    {
        return $day->rawFormat('N') <= 5;
    }

    /**
     * 평일 카운트
     *
     * @param $start
     * @param $end
     * @param array $input
     * @return int
     */
    public function countWorkday($start, $end, array $input): int
    {
        $days = 0;
        while ($start <= $end) {
            // Log::info('date : '.$start->toDateString());
            if ($this->isWorkday($start)) {
                // week 설정이 되어 있으면 해당 week의 workday를 구함. (1 - 월요일, 7 - 일요일)
                if (isset($input['week'])) {
                    if ($input['week'] == $start->rawFormat('N')) {
                        $days++;
                    }
                } else {
                    $days++;
                }
            }
            $start->addDay();
        }
        return $days;
    }
}
