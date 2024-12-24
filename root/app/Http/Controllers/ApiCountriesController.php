<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\JsonResponse;

class ApiCountriesController extends Controller
{
    public function getAllCountries(): JsonResponse
    {
        $countriesData = [
            "error" => 0,
            "error_text" => "Lấy dữ liệu quốc gia thành công..!",
            "data_name" => "Quốc gia trên thế giới",
            "data" => [
                ["code" => "VN", "name" => "Việt Nam"],
                ["code" => "US", "name" => "Hoa Kỳ"],
                ["code" => "JP", "name" => "Nhật Bản"],
                ["code" => "FR", "name" => "Pháp"],
                ["code" => "DE", "name" => "Đức"],
                ["code" => "CN", "name" => "Trung Quốc"],
                ["code" => "KR", "name" => "Hàn Quốc"],
                ["code" => "TH", "name" => "Thái Lan"],
                ["code" => "SG", "name" => "Singapore"],
                ["code" => "MY", "name" => "Malaysia"],
                ["code" => "PH", "name" => "Philippines"],
                ["code" => "ID", "name" => "Indonesia"],
                ["code" => "IN", "name" => "Ấn Độ"],
                ["code" => "AU", "name" => "Úc"],
                ["code" => "CA", "name" => "Canada"],
                ["code" => "BR", "name" => "Brazil"],
                ["code" => "AR", "name" => "Argentina"],
                ["code" => "MX", "name" => "Mexico"],
                ["code" => "RU", "name" => "Nga"],
                ["code" => "GB", "name" => "Vương Quốc Anh"],
                ["code" => "IT", "name" => "Ý"],
                ["code" => "ES", "name" => "Tây Ban Nha"],
                ["code" => "NL", "name" => "Hà Lan"],
                ["code" => "SE", "name" => "Thụy Điển"],
                ["code" => "CH", "name" => "Thụy Sĩ"],
                ["code" => "BE", "name" => "Bỉ"],
                ["code" => "FI", "name" => "Phần Lan"],
                ["code" => "NO", "name" => "Na Uy"],
                ["code" => "DK", "name" => "Đan Mạch"],
                ["code" => "PL", "name" => "Ba Lan"],
                ["code" => "BN", "name" => "Brunei"],
                ["code" => "LA", "name" => "Lào"],
                ["code" => "KH", "name" => "Campuchia"],
                ["code" => "MM", "name" => "Myanmar"],
                ["code" => "TL", "name" => "Timor-Leste"],
            ]
        ];
        return response()->json($countriesData);
    }
}
