<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Education;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PortfolioController extends Controller
{
    public function index()
    {
        $profile = Cache::remember('profile', 3600, function () {
            return Profile::first();
        });
        
        $education = Cache::remember('education', 3600, function () {
            return Education::orderBy('order')->get();
        });
        
        $projects = Cache::remember('projects', 3600, function () {
            return Project::orderBy('order')->get();
        });
        
        $testimonials = Cache::remember('testimonials', 3600, function () {
            return Testimonial::where('is_active', true)->orderBy('order')->get();
        });

        return view('index', compact('profile', 'education', 'projects', 'testimonials'));
    }

    public function about()
    {
        $profile = Cache::remember('profile', 3600, function () {
            return Profile::first();
        });
        
        $skills = Cache::remember('skills', 3600, function () {
            return Skill::where('is_active', true)->orderBy('order')->get();
        });
        
        $experiences = Cache::remember('experiences', 3600, function () {
            return Experience::where('is_active', true)->orderBy('start_date', 'desc')->get();
        });
        
        $achievements = Cache::remember('achievements', 3600, function () {
            return Achievement::where('is_active', true)->orderBy('date', 'desc')->get();
        });
        
        // Tambahan data untuk about page
        $projectsCount = Cache::remember('projects_count', 3600, function () {
            return Project::count() ?: 50;
        });
        
        $experienceYears = 5; // atau hitung dari experience
        $clientsCount = 30; // atau ambil dari database
        
        return view('about', compact(
            'profile', 
            'skills', 
            'experiences', 
            'achievements',
            'projectsCount',
            'experienceYears', 
            'clientsCount'
        ));
    }

    public function contact()
    {
        $profile = Cache::remember('profile', 3600, function () {
            return Profile::first();
        });
        
        return view('contact', compact('profile'));
    }
}