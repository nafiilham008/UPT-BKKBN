<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Download\Material;
use App\Models\Download\PublicInformation;
use App\Models\Gallery;
use App\Models\Information\ButtonBanner;
use App\Models\Information\Scholarship;
use App\Models\OtherCourse;
use App\Models\Post;
use App\Models\Profile\EducationHistory;
use App\Models\Profile\Employee;
use App\Models\Profile\Historical;
use App\Models\Profile\Jobandfunc;
use App\Models\PublicService\ServiceInformation;
use App\Models\PublicService\WorkAccountability;
use App\Models\Training\Calendar;
use App\Models\Training\Collaboration;
use App\Models\Training\ProfileTraining;
use App\Models\visitor;
use App\Utilities\Constant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Post::where('highlight', 1)->get();

        $postNews = $this->getPostNews();
        $postArticle = $this->getPostArticle();
        $postInformation = $this->getPostInformation();

        $history = Historical::all();

        $constant = Constant::CATEGORY;

        $buttonBanner = ButtonBanner::all();

        $trackVisitor = $this->trackVisitor();
        


        return view('front.landing.index', compact('banner', 'postNews', 'postArticle', 'postInformation', 'constant', 'history', 'buttonBanner', 'trackVisitor'));
    }

    public function trackVisitor()
    {
        $date = Carbon::now()->toDateString();
        $dayOfWeek = Carbon::now()->dayOfWeek;
        $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $startOfYear = Carbon::now()->startOfYear()->toDateString();

        // Cek apakah session pengunjung telah diset
        if (!session()->has('visitor')) {
            $visitor = Visitor::firstOrNew(['date' => $date]);
            $visitor->day_count++;
            $visitor->save();

            // Set session pengunjung
            session(['visitor' => $visitor->id]);
        } else {
            $visitorId = session('visitor');
            $visitor = Visitor::find($visitorId);

            // Cek apakah pengunjung telah tercatat pada hari yang sama
            if ($visitor && $visitor->date === $date) {
                // Jika pengunjung sudah tercatat pada hari yang sama, tidak ada penambahan
                return;
            } else {
                // Jika pengunjung baru atau hari berbeda, tambahkan pengunjung baru
                $newVisitor = Visitor::create(['date' => $date]);
                $newVisitor->day_count++;

                // Update session pengunjung
                session(['visitor' => $newVisitor->id]);
            }
        }

        // Reset week_count jika hari saat ini adalah hari Senin
        if ($dayOfWeek === Carbon::MONDAY) {
            Visitor::where('date', '>=', $startOfWeek)->update(['week_count' => 0]);
        }

        Visitor::where('date', '>=', $startOfWeek)->increment('week_count');
        Visitor::where('date', '>=', $startOfMonth)->increment('month_count');
        Visitor::where('date', '>=', $startOfYear)->increment('year_count');
    }


    public function getPostNews()
    {
        $postNews = Post::with('categories', 'users')
            ->where('status', 1)
            ->whereHas('categories', function ($query) {
                $query->where('label', '=', 'Berita');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(4);


        if (request()->ajax()) {

            return view('front.landing.components.postnews', compact('postNews'))->render();
            // return response()->json(['html' => $view]);
        }
        return $postNews;
    }

    public function getPostArticle()
    {
        $postArticle = Post::with('categories', 'users')
            ->where('status', 1)
            ->whereHas('categories', function ($query) {
                $query->where('label', '=', 'Artikel');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return $postArticle;
    }

    public function getPostInformation()
    {
        $postInformation = Post::with('categories', 'users')
            ->where('status', 1)
            ->whereHas('categories', function ($query) {
                $query->where('label', '=', 'Informasi');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return $postInformation;
    }

    public function getCategory($categories, $slug_url)
    {

        $getCategory = Post::with('categories', 'users')
            ->where('status', 1)
            ->whereHas('categories', function ($query) use ($categories) {
                $query->where('label',  $categories);
            })
            ->where('slug_url', '!=', $slug_url)
            ->inRandomOrder()
            ->paginate(4);

        return $getCategory;
    }

    public function detail($categories, $slug_url)
    {
        // $post->load('users:id,name', 'categories:id,label');
        // $post = Post::with('categories', 'users')->where('slug_url', $slug_url)->first();

        $post = Post::with('categories', 'users')
            ->where('slug_url', $slug_url)
            ->whereHas('categories', function ($query) use ($categories) {
                $query->where('label', $categories);
            })
            ->first();

        $getCategory = $this->getCategory($categories, $slug_url);



        return view('front.landing.detail', compact('post', 'getCategory'));
    }

    // Profile Menu
    public function profile()
    {
        $history = Historical::all();
        $jobandfunc = Jobandfunc::all();
        $employee = Employee::all();

        $structural = $this->getTypeStructural();
        $widyaiswara = $this->getTypeWidyaiswara();
        $functional = $this->getTypeFunctional();
        $executor = $this->getTypeExecutor();
        $ppnpn = $this->getTypePpnpn();


        return view('front.profile.index', compact('history', 'jobandfunc', 'employee', 'structural', 'widyaiswara', 'functional', 'executor', 'ppnpn'));
    }

    public function detailHistory()
    {
        $history = Historical::all()->first();
        return view('front.landing.detail-history', compact('history'));
    }
    public function getTypeStructural()
    {
        return Employee::where('type_employee', 1)->with('educationHistories', 'employeeHistories')->get();
    }

    public function getTypeWidyaiswara()
    {
        return Employee::where('type_employee', 2)->with('educationHistories', 'employeeHistories')->get();
    }


    public function getTypeFunctional()
    {
        return Employee::where('type_employee', 3)->with('educationHistories', 'employeeHistories')->get();
    }

    public function getTypeExecutor()
    {
        return Employee::where('type_employee', 4)->with('educationHistories', 'employeeHistories')->get();
    }

    public function getTypePpnpn()
    {
        return Employee::where('type_employee', 5)->with('educationHistories', 'employeeHistories')->get();
    }

    public function getEmployeesDetail($id)
    {
        $employee = Employee::findOrFail($id);

        // Return data as JSON
        return response()->json([
            'success' => true,
            'employee' => $employee
        ]);
    }
    // End Profile Menu

    // Training Menu
    public function training()
    {
        $calendar = Calendar::all();
        $profileInstructor = $this->getTypeWidyaiswara();
        $collaboration = Collaboration::all();
        $training = ProfileTraining::all();


        return view('front.training.index', compact('calendar', 'profileInstructor', 'collaboration', 'training'));
    }

    // End Training

    // Documentation

    public function documentation()
    {
        try {
            $gallery = Gallery::with('posts')->get();
            return view('front.documentation.index', compact('gallery'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    // End Documentation

    // Information

    public function scholarship()
    {
        try {
            $scholarship = Scholarship::all();

            return view('front.scholarship.index', compact('scholarship'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function otherCourse()
    {
        try {
            $otherCourse = $this->getOtherCourse();

            return view('front.other-course.index', compact('otherCourse'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function getScholarshipDetail($id)
    {
        $scholarship = Scholarship::findOrFail($id);

        // Return data as JSON
        return response()->json([
            'success' => true,
            'scholarship' => $scholarship
        ]);
    }

    public function getOtherCourse()
    {
        $otherCourse = OtherCourse::all();

        return $otherCourse;
    }

    // End Information

    // Download

    public function download()
    {
        try {
            $download = Material::all();

            return view('front.download.material.index', compact('download'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    // End Download

    // publicService

    public function publicService()
    {
        try {

            $typePublicInformation = Constant::TYPE_OF_PUBLIC_INFORMATION;
            $publicService = PublicInformation::all();

            $workAccountability = WorkAccountability::all();
            $serviceInformation = ServiceInformation::all();

            return view('front.public-service.index', compact('publicService', 'typePublicInformation', 'workAccountability', 'serviceInformation'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    // End publicService
}
