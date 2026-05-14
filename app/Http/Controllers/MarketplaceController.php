<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MarketplaceController extends Controller
{
    // Hardcoded categories map simulating DB rows for visual fidelity
    private array $categories = [
        ['slug' => 'plumbing', 'name' => 'Plumbing', 'desc' => 'Leak Repair, Pipe Routing', 'image' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=500&auto=format&fit=crop'],
        ['slug' => 'electrical', 'name' => 'Electrical', 'desc' => 'Circuit Repair, Smart Home', 'image' => 'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?w=500&auto=format&fit=crop'],
        ['slug' => 'cleaning', 'name' => 'Home Cleaning', 'desc' => 'Full Sanitization, Office', 'image' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=500&auto=format&fit=crop'],
        ['slug' => 'hvac', 'name' => 'HVAC & AC', 'desc' => 'Filter Replacement, Compressor', 'image' => 'https://images.unsplash.com/photo-1590488057200-e1458e0a3237?w=500&auto=format&fit=crop'],
        ['slug' => 'carpentry', 'name' => 'Carpentry', 'desc' => 'Cabinetry, Furniture Repair', 'image' => 'https://images.unsplash.com/photo-1581141849291-1125c7b692b5?w=500&auto=format&fit=crop'],
        ['slug' => 'painting', 'name' => 'Painting', 'desc' => 'Interior, Exterior, Touchups', 'image' => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=500&auto=format&fit=crop']
    ];

    public function services(Request $request)
    {
        return view('marketplace.services', [
            'categories' => collect($this->categories)
        ]);
    }

    public function professionals(Request $request)
    {
        $category = $request->query('category', 'all');
        
        // Fetch users acting as professionals
        $query = User::where('Role', 'Handyman');
        $handymen = $query->get();

        // Authentic map
        $handymen->map(function ($handyman) {
            $userTags = is_string($handyman->Tags) ? json_decode($handyman->Tags, true) ?? [] : (is_array($handyman->Tags) ? $handyman->Tags : []);
            $userTags = array_map('strtolower', array_map('trim', $userTags));
            
            $primary = count($userTags) > 0 ? $userTags[0] : 'Handyman';
            $handyman->primaryCategory = ucwords($primary);
            $handyman->TagsArray = $userTags;
            
            // Calculate real rating from database
            $handyman->average_rating = \App\Models\Rating::where('HandymanID', $handyman->UserID)->avg('Rating') ?? 0;
            return $handyman;
        });

        // Filter the collection if category specified
        if ($category !== 'all') {
            $handymen = $handymen->filter(function($h) use ($category) {
                $catData = collect($this->categories)->firstWhere('slug', $category);
                $searchTerms = [strtolower($category)];
                if ($catData) {
                    $searchTerms[] = strtolower($catData['name']);
                }
                
                // Return true if any of the search terms match an item in the user's tags array
                return count(array_intersect($searchTerms, $h->TagsArray)) > 0;
            });
        }

        return view('marketplace.professionals', [
            'handymen' => $handymen,
            'currentCategory' => $category,
            'categories' => collect($this->categories)
        ]);
    }
}
