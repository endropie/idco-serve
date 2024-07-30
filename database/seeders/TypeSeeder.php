<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        $this->createRtypes();
        $this->createR0types();
        $this->createFltypes();
        $this->createMaterials();
        $this->createTools();
        $this->createCoats();
    }

    protected function createRtypes()
    {
        $array = collect([
            "0.5R",
            "2R",
            "3R",
            "4R",
            "5R",
            "6R",
        ]);

        $array->each(function ($e)  {
            \App\Models\Rtype::updateOrCreate(['code' => $e]);
        });
    }

    protected function createR0types()
    {
        $array = collect([
            "1\"",
            "2\"",
            "3\"",
            "4\"",
            "5\"",
            "6\"",
        ]);

        $array->each(function ($e)  {
            \App\Models\R0type::updateOrCreate(['code' => $e]);
        });
    }

    protected function createFltypes()
    {
        $array = collect([
            "2T",
            "3T",
            "4T",
        ]);

        $array->each(function ($e)  {
            \App\Models\Fltype::updateOrCreate(['code' => $e]);
        });
    }

    protected function createMaterials()
    {
        $array = collect([
            "HSS",
            "Carbide",
            "Tool Steel",
        ]);

        $array->each(function ($e)  {
            $request = new Request(['name' => $e]);
            app(\App\Http\ApiControllers\MaterialController::class)->save($request);
        });
    }

    protected function createCoats()
    {
        $array = collect([
            "X-Coat",
            "SiS-Coat",
            "TiC-Coat",
            "TiN-Coat",
            "Cr-Coat",
            "CrC-Coat",
            "Cro-Coat",
            "Du-Coat",
            "TOP-Coat",
            "Sup-Coat",
            "Tig-Coat",
            "Z-Coat",
            "Var-Coat",
            "Zirc-Coat",
            "Zir-Coat",
        ]);

        $array->each(function ($e)  {
            $request = new Request(['name' => $e]);
            app(\App\Http\ApiControllers\CoatController::class)->save($request);
        });
    }

    protected function createTools()
    {
        $array = collect([
            "Shank Tools",
            "Twist Drill",
            "Step Drill",
            "Center Drill",
            "Countersink Drill ",
            "Counterbore Drill ",
            "Square End Mills",
            "Ball Nose End Mills",
            "Corner Radius End Mills",
            "Roughing End Mills",
            "Face Mills",
            "Slab Mills",
            "Thread Mills",
            "Chamfer Mills",
            "Reamers",
            "Taps",
            "Micro End Mills",
            "Micro Drills",
            "Micro Reamers",
            "Gear Hobs",
            "Shaving Hobs",
            "Pre-Shaving Hobs",
            "Chamfering Hobs",
            "Thread Milling Hobs",
            "Spline Hobs",
            "Broaches",
            "Disc Cutter",
            "Punch & Pin",
            "Insert Milling",
            "Mold & Die",
        ]);

        $array->each(function ($e)  {
            $request = new Request(['name' => $e]);
            app(\App\Http\ApiControllers\ToolController::class)->save($request);
        });
    }
}
