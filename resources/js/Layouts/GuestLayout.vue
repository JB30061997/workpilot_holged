<script setup>
import { ref } from "vue";

const logoUrl = "/images/logo/logo_workpilot.png";

const stars = ref(
    Array.from({ length: 22 }, (_, i) => ({
        id: i,
        left: `${(i * 47.31 + 13) % 100}%`,
        top: `${(i * 19.73 + 4) % 65}%`,
        delay: `${(i * 0.71) % 8}s`,
        duration: `${2 + (i % 4)}s`,
    })),
);
</script>

<template>
    <div
        class="wp-auth-shell relative isolate flex min-h-dvh items-center justify-center overflow-hidden px-4 py-10 sm:px-6"
    >
        <!-- Image de fond -->
        <div class="wp-auth-background absolute inset-0"></div>

        <!-- Overlay sombre -->
        <div class="pointer-events-none absolute inset-0 bg-slate-950/25"></div>

        <!-- Étoiles animées -->
        <div
            class="pointer-events-none absolute inset-0 overflow-hidden"
            aria-hidden="true"
        >
            <span
                v-for="star in stars"
                :key="star.id"
                class="wp-star"
                :style="{
                    left: star.left,
                    top: star.top,
                    animationDelay: star.delay,
                    animationDuration: star.duration,
                }"
            ></span>

            <span class="wp-shooting-star shooting-one"></span>
            <span class="wp-shooting-star shooting-two"></span>
            <span class="wp-shooting-star shooting-three"></span>
        </div>

        <!-- Contenu principal -->
        <div class="relative z-10 w-full max-w-[560px]">
            <!-- Logo officiel WorkPilot -->
            <div class="mb-7 flex items-center justify-center">
                <img :src="logoUrl" alt="WorkPilot" class="wp-auth-logo" />
            </div>

            <!-- Formulaire Login / Register -->
            <slot />
        </div>
    </div>
</template>

<style scoped>
.wp-auth-shell {
    background: #06152e;
}

/* IMAGE DE FOND */
.wp-auth-background {
    background-image: url("/images/auth_background.png");
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    animation: wp-background-zoom 30s ease-in-out infinite alternate;
}

/* LOGO WORKPILOT */
.wp-auth-logo {
    display: block;
    width: auto;
    max-width: 260px;
    max-height: 110px;
    height: auto;
    object-fit: contain;
    filter: drop-shadow(0 8px 20px rgba(0, 0, 0, 0.3));
    animation: wp-logo-enter 800ms ease-out both;
}

/* ÉTOILES */
.wp-star {
    position: absolute;
    width: 3px;
    height: 3px;
    border-radius: 50%;
    background: white;
    box-shadow: 0 0 8px 2px rgba(147, 197, 253, 0.8);
    animation: wp-twinkle 3s ease-in-out infinite alternate;
}

/* ÉTOILES FILANTES */
.wp-shooting-star {
    position: absolute;
    width: 130px;
    height: 2px;
    border-radius: 999px;
    background: linear-gradient(90deg, transparent, #93c5fd, white);
    opacity: 0;
    transform: rotate(-25deg);
    animation: wp-shoot 8s linear infinite;
}

.shooting-one {
    top: 12%;
    left: 15%;
}

.shooting-two {
    top: 22%;
    left: 55%;
    animation-delay: 3s;
}

.shooting-three {
    top: 8%;
    left: 75%;
    animation-delay: 6s;
}

/* ANIMATIONS */
@keyframes wp-background-zoom {
    from {
        transform: scale(1);
    }
    to {
        transform: scale(1.06);
    }
}

@keyframes wp-logo-enter {
    from {
        opacity: 0;
        transform: translateY(-12px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes wp-twinkle {
    0%,
    100% {
        opacity: 0.2;
        transform: scale(0.7);
    }
    50% {
        opacity: 1;
        transform: scale(1.4);
    }
}

@keyframes wp-shoot {
    0%,
    80% {
        opacity: 0;
        transform: translate(0, 0) rotate(-25deg);
    }
    83% {
        opacity: 1;
    }
    94%,
    100% {
        opacity: 0;
        transform: translate(250px, 120px) rotate(-25deg);
    }
}

/* RESPONSIVE */
@media (max-width: 639px) {
    .wp-auth-logo {
        max-width: 210px;
        max-height: 90px;
    }
}

/* ACCESSIBILITÉ */
@media (prefers-reduced-motion: reduce) {
    .wp-auth-background,
    .wp-auth-logo,
    .wp-star,
    .wp-shooting-star {
        animation: none;
    }
}
</style>
