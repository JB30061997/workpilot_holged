<script setup>
import { Head, Link } from "@inertiajs/vue3";

const stars = Array.from({ length: 22 }, (_, i) => ({
    left: `${(i * 47.31 + 13) % 100}%`,
    top: `${(i * 19.73 + 4) % 65}%`,
    delay: `${(i * 0.71) % 8}s`,
    duration: `${2 + (i % 4)}s`,
}));

defineProps({
    canLogin: {
        type: Boolean,
        default: true,
    },
    canRegister: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <Head title="Bienvenue | WorkPilot" />

    <main class="welcome-stage">
        <!-- Même fond que les pages de connexion -->
        <div class="welcome-background" aria-hidden="true"></div>
        <div class="welcome-overlay" aria-hidden="true"></div>
        <div class="welcome-stars" aria-hidden="true">
            <span
                v-for="(star, index) in stars"
                :key="index"
                class="welcome-star"
                :style="{
                    left: star.left,
                    top: star.top,
                    animationDelay: star.delay,
                    animationDuration: star.duration,
                }"
            ></span>
            <span class="welcome-shooting-star shooting-one"></span>
            <span class="welcome-shooting-star shooting-two"></span>
            <span class="welcome-shooting-star shooting-three"></span>
        </div>

        <div class="welcome-container">
            <!-- Logo WorkPilot -->
            <div class="welcome-brand">
                <div class="welcome-brand-icon">
                    <svg
                        width="25"
                        height="25"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M2 12h5l3-7 4 14 3-7h5" />
                    </svg>
                </div>

                <span>WorkPilot</span>
            </div>

            <!-- Card principale -->
            <section class="welcome-center-card">
                <div class="welcome-content">
                    <p class="welcome-eyebrow">BIENVENUE SUR WORKPILOT</p>

                    <h1 class="welcome-title">Votre espace de travail.</h1>

                    <p class="welcome-description">
                        Pilotez vos projets, organisez vos équipes et suivez vos
                        activités depuis un seul espace.
                    </p>

                    <!-- Séparateur -->
                    <div class="welcome-divider"></div>

                    <!-- Actions -->
                    <div class="welcome-actions">
                        <Link
                            v-if="canLogin"
                            :href="route('login')"
                            class="welcome-action welcome-action-primary"
                        >
                            <span class="action-content">
                                <svg
                                    width="19"
                                    height="19"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <path d="M10 17l5-5-5-5" />
                                    <path d="M15 12H3" />
                                    <path
                                        d="M12 3h6a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3h-6"
                                    />
                                </svg>

                                Se connecter
                            </span>

                            <svg
                                class="action-arrow"
                                width="19"
                                height="19"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="welcome-action welcome-action-secondary"
                        >
                            <span class="action-content">
                                <svg
                                    width="19"
                                    height="19"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <circle cx="9" cy="8" r="4" />
                                    <path d="M2 21v-2a7 7 0 0 1 14 0v2" />
                                    <path d="M19 8v8" />
                                    <path d="M15 12h8" />
                                </svg>

                                Créer un compte
                            </span>

                            <svg
                                class="action-arrow"
                                width="19"
                                height="19"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                        </Link>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <p class="welcome-footer">WorkPilot · Management Platform</p>
        </div>
    </main>
</template>

<style scoped>
/* ==============================
   PAGE BACKGROUND
================================ */

.welcome-stage {
    position: relative;
    display: flex;
    width: 100%;
    min-height: 100vh;
    min-height: 100dvh;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 40px 20px;
    background: #06152e;
}

/* ==============================
   CONTAINER
================================ */

.welcome-container {
    position: relative;
    z-index: 1;
    display: flex;
    width: 100%;
    max-width: 540px;
    flex-direction: column;
    align-items: center;
}

/* ==============================
   BRAND
================================ */

.welcome-brand {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 11px;
    margin-bottom: 28px;
    color: #ffffff;
    font-size: 16px;
    font-weight: 800;
    letter-spacing: -0.04em;
}

.welcome-brand-icon {
    display: flex;
    width: 38px;
    height: 38px;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: #2563eb;
    color: white;
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.22);
}

/* ==============================
   WHITE CARD
================================ */

.welcome-center-card {
    position: relative;
    box-sizing: border-box;
    width: 100%;
    padding: 48px;
    border: 1px solid rgba(255, 255, 255, 0.6);
    border-radius: 18px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    box-shadow: 0 30px 90px rgba(0, 0, 0, 0.35);
    animation: welcome-card-in 650ms cubic-bezier(0.22, 1, 0.36, 1) both;
}

.welcome-content {
    width: 100%;
    min-width: 0;
}

/* ==============================
   TYPOGRAPHY
================================ */

.welcome-eyebrow {
    margin: 0;
    color: #2563eb;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.12em;
}

.welcome-title {
    margin-top: 15px;
    color: #0f172a;
    font-size: clamp(27px, 4vw, 34px);
    font-weight: 800;
    letter-spacing: -0.045em;
    line-height: 1.2;
}

.welcome-description {
    margin-top: 15px;
    color: #64748b;
    font-size: 14px;
    line-height: 1.85;
}

/* ==============================
   DIVIDER
================================ */

.welcome-divider {
    width: 100%;
    height: 1px;
    margin: 28px 0;
    background: #e9eef5;
}

/* ==============================
   BUTTONS
================================ */

.welcome-actions {
    display: grid;
    gap: 13px;
}

.welcome-action {
    display: flex;
    width: 100%;
    min-height: 54px;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding: 0 20px;
    border-radius: 9px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    transition:
        background 250ms ease,
        border-color 250ms ease,
        color 250ms ease,
        transform 250ms ease,
        box-shadow 250ms ease;
}

.action-content {
    display: inline-flex;
    align-items: center;
    gap: 12px;
}

.action-arrow {
    flex-shrink: 0;
    transition: transform 250ms ease;
}

.welcome-action:hover .action-arrow {
    transform: translateX(4px);
}

/* Primary button */

.welcome-action-primary {
    border: 1px solid #2563eb;
    background: #2563eb;
    color: #ffffff;
    box-shadow: 0 12px 24px rgba(37, 99, 235, 0.17);
}

.welcome-action-primary:hover {
    background: #1d4ed8;
    border-color: #1d4ed8;
    transform: translateY(-2px);
    box-shadow: 0 15px 28px rgba(37, 99, 235, 0.23);
}

/* Secondary button */

.welcome-action-secondary {
    border: 1px solid #dbe5f2;
    background: #06152e;
    color: #2563eb;
}

.welcome-action-secondary:hover {
    border-color: #93c5fd;
    background: #eff6ff;
    transform: translateY(-2px);
}

/* ==============================
   FOOTER
================================ */

.welcome-footer {
    margin-top: 26px;
    color: rgba(255, 255, 255, 0.82);
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.025em;
    text-align: center;
}

/* ==============================
   ANIMATIONS
================================ */

@keyframes welcome-card-in {
    from {
        opacity: 0;
        transform: translateY(20px) scale(0.985);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* ==============================
   RESPONSIVE
================================ */

@media (max-width: 639px) {
    .welcome-stage {
        padding: 24px 16px;
    }

    .welcome-container {
        max-width: 100%;
    }

    .welcome-center-card {
        padding: 34px 26px;
    }

    .welcome-title {
        font-size: 28px;
    }

    .welcome-description {
        font-size: 13px;
    }

    .welcome-action {
        min-height: 52px;
        padding: 0 16px;
    }
}

/* ==============================
   ACCESSIBILITY
================================ */

@media (prefers-reduced-motion: reduce) {
    .welcome-center-card {
        animation: none;
    }

    .welcome-action,
    .action-arrow {
        transition: none;
    }
}

/* Fond commun aux écrans d’authentification */
.welcome-background,
.welcome-overlay,
.welcome-stars {
    position: absolute;
    inset: 0;
    pointer-events: none;
}
.welcome-background {
    background: url("/images/auth_background.png") center / cover no-repeat;
    animation: welcome-bg-zoom 30s ease-in-out infinite alternate;
}
.welcome-overlay {
    background: rgba(2, 6, 23, 0.25);
}
.welcome-stars {
    overflow: hidden;
}
.welcome-star {
    position: absolute;
    width: 3px;
    height: 3px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 0 8px 2px rgba(147, 197, 253, 0.8);
    animation: welcome-twinkle 3s ease-in-out infinite alternate;
}
.welcome-shooting-star {
    position: absolute;
    width: 130px;
    height: 2px;
    border-radius: 999px;
    background: linear-gradient(90deg, transparent, #93c5fd, #fff);
    opacity: 0;
    transform: rotate(-25deg);
    animation: welcome-shoot 8s linear infinite;
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
@keyframes welcome-bg-zoom {
    from {
        transform: scale(1);
    }
    to {
        transform: scale(1.06);
    }
}
@keyframes welcome-twinkle {
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
@keyframes welcome-shoot {
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
@media (prefers-reduced-motion: reduce) {
    .welcome-background,
    .welcome-star,
    .welcome-shooting-star {
        animation: none;
    }
}
</style>
