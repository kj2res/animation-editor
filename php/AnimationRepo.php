<?php

namespace AnimationEditor;

class AnimationRepo
{
    const FILE = __DIR__ . "/data.json";

    /**
     * Handle posting JSON directly to save it
     */
    function handleSave()
    {
        file_put_contents(self::FILE, file_get_contents('php://input'));
        return 'ok';
    }

    function load(): array
    {
        return json_decode(file_get_contents(self::FILE) ?: '{}', true) ?? [];
    }

    public function getStyle()
    {
        //@TODO implment dynamically create css animations
        return <<<ENDCSS
@keyframes ANIMATE-1 {

    0% {
        transform: translateX(-100%);
    }

    100% {
        transform: translateX(0);
    }

}

.animate1 {
    animation-delay: 1s;
    animation: ANIMATE-1 2.5s;
}
ENDCSS;

    }
}