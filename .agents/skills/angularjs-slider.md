# Skill: AngularJS Dynamic Hero Slider & Legacy Bridge

## Context & Overview
In the **Full-Stack Laravel Developer Theme** (`resources/views/frontend/themes/laravel_developer/index.blade.php`), the hero section features an interactive, animated multi-part slider powered by **AngularJS**.

---

## 1. Architecture of the Hero Slider
The slider orchestrates animated slides highlighting different facets of full-stack engineering (e.g. ERP Systems, High-Concurrency APIs, Cloud Deployment).

```html
<section id="heroSlider" ng-app="heroSliderApp" ng-controller="HeroSliderController"
         ng-mouseenter="pauseSlider()" ng-mouseleave="resumeSlider()">
    <!-- Slide elements controlled via ng-repeat or active index -->
    <div class="slider-slide" ng-class="{'active': currentSlideIndex === $index}">
        ...
    </div>
</section>
```

---

## 2. Scope & Controller Conventions
```javascript
angular.module('heroSliderApp', [])
.controller('HeroSliderController', ['$scope', '$interval', function($scope, $interval) {
    $scope.currentSlideIndex = 0;
    $scope.slides = [...]; // Injected or dynamic slides
    $scope.isPaused = false;

    let timer = $interval(function() {
        if (!$scope.isPaused) {
            $scope.nextSlide();
        }
    }, 6000);

    $scope.pauseSlider = function() { $scope.isPaused = true; };
    $scope.resumeSlider = function() { $scope.isPaused = false; };
    $scope.nextSlide = function() {
        $scope.currentSlideIndex = ($scope.currentSlideIndex + 1) % $scope.slides.length;
    };
    $scope.prevSlide = function() {
        $scope.currentSlideIndex = ($scope.currentSlideIndex - 1 + $scope.slides.length) % $scope.slides.length;
    };

    $scope.$on('$destroy', function() {
        if (timer) $interval.cancel(timer);
    });
}]);
```

---

## 3. Coexistence Guidelines (No Framework Collisions)
- **Scope Isolation**: AngularJS is strictly scoped to `#heroSlider` (`ng-app="heroSliderApp"`). Never mount AngularJS to `<html>` or `<body>` to prevent collisions with Alpine.js or Vue/React components.
- **Blade Syntax Collision**: When outputting AngularJS interpolations inside Blade, use `@{{ variable }}` so Laravel does not attempt to parse it as PHP.
- **Clean Fallbacks**: Ensure semantic HTML and CSS transitions render gracefully even if JavaScript execution is deferred.
