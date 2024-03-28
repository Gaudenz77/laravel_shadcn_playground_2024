<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Button } from "@/Components/ui/button";
import { Alert, AlertDescription, AlertTitle } from "@/Components/ui/alert";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/Components/ui/dialog";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";

import { ref } from "vue";
import { MinusIcon, PlusIcon } from "@radix-icons/vue";
import { VisStackedBar, VisXYContainer } from '@unovis/vue'
 import {
    Drawer,
    DrawerClose,
    DrawerContent,
    DrawerDescription,
    DrawerFooter,
    DrawerHeader,
    DrawerTitle,
    DrawerTrigger,
} from "@/Components/ui/drawer";

const goal = ref(350);

type Data = (typeof data)[number];
const data = [
    { goal: 400 },
    { goal: 300 },
    { goal: 200 },
    { goal: 300 },
    { goal: 200 },
    { goal: 278 },
    { goal: 189 },
    { goal: 239 },
    { goal: 300 },
    { goal: 200 },
    { goal: 278 },
    { goal: 189 },
    { goal: 349 },
];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in! Indeed...?</div>
                    <div>
                        <Button variant="destructive">Button</Button>
                    </div>
                    <div>
                        <Alert>
                            <AlertTitle>Heads up!</AlertTitle>
                            <AlertDescription>
                                You can add Components to your app using the
                                cli.
                            </AlertDescription>
                        </Alert>
                    </div>
                    <div>
                        <Dialog>
                            <DialogTrigger as-child>
                                <Button variant="outline">
                                    Edit Profile
                                </Button>
                            </DialogTrigger>
                            <DialogContent class="sm:max-w-[425px]">
                                <DialogHeader>
                                    <DialogTitle>Edit profile</DialogTitle>
                                    <DialogDescription>
                                        Make changes to your profile here. Click
                                        save when you're done.
                                    </DialogDescription>
                                </DialogHeader>
                                <div class="grid gap-4 py-4">
                                    <div
                                        class="grid grid-cols-4 items-center gap-4"
                                    >
                                        <Label for="name" class="text-right">
                                            Name
                                        </Label>
                                        <Input
                                            id="name"
                                            value="Pedro Duarte"
                                            class="col-span-3"
                                        />
                                    </div>
                                    <div
                                        class="grid grid-cols-4 items-center gap-4"
                                    >
                                        <Label
                                            for="username"
                                            class="text-right"
                                        >
                                            Username
                                        </Label>
                                        <Input
                                            id="username"
                                            value="@peduarte"
                                            class="col-span-3"
                                        />
                                    </div>
                                </div>
                                <DialogFooter>
                                    <Button type="submit">
                                        Save changes
                                    </Button>
                                </DialogFooter>
                            </DialogContent>
                        </Dialog>
                    </div>
                    <div>
                        <Drawer>
                            <DrawerTrigger as-child>
                                <Button variant="outline"> Open Drawer </Button>
                            </DrawerTrigger>
                            <DrawerContent>
                                <div class="mx-auto w-full max-w-sm">
                                    <DrawerHeader>
                                        <DrawerTitle>Move Goal</DrawerTitle>
                                        <DrawerDescription
                                            >Set your daily activity
                                            goal.</DrawerDescription
                                        >
                                    </DrawerHeader>
                                    <div class="p-4 pb-0">
                                        <div
                                            class="flex items-center justify-center space-x-2"
                                        >
                                            <Button
                                                variant="outline"
                                                size="icon"
                                                class="h-8 w-8 shrink-0 rounded-full"
                                                :disabled="goal <= 200"
                                                @click="goal -= 10"
                                            >
                                                <MinusIcon class="h-4 w-4" />
                                                <span class="sr-only"
                                                    >Decrease</span
                                                >
                                            </Button>
                                            <div class="flex-1 text-center">
                                                <div
                                                    class="text-7xl font-bold tracking-tighter"
                                                >
                                                    {{ goal }}
                                                </div>
                                                <div
                                                    class="text-[0.70rem] uppercase text-muted-foreground"
                                                >
                                                    Calories/day
                                                </div>
                                            </div>
                                            <Button
                                                variant="outline"
                                                size="icon"
                                                class="h-8 w-8 shrink-0 rounded-full"
                                                :disabled="goal >= 400"
                                                @click="goal += 10"
                                            >
                                                <PlusIcon class="h-4 w-4" />
                                                <span class="sr-only"
                                                    >Increase</span
                                                >
                                            </Button>
                                        </div>
                                        <div class="my-3 px-3 h-[120px]">
                                            <VisXYContainer
                                                :data="data"
                                                class="h-[120px]"
                                                :style="{
                                                    opacity: 0.9,
                                                    '--theme-primary': `hsl(var(--foreground))`,
                                                }"
                                            >
                                                <VisStackedBar
                                                    :x="(d: Data, i :number) => i"
                                                    :y="(d: Data) => d.goal"
                                                    color="var(--theme-primary)"
                                                    :bar-padding="0.1"
                                                    :rounded-corners="0"
                                                />
                                            </VisXYContainer>
                                        </div>
                                    </div>
                                    <DrawerFooter>
                                        <Button>Submit</Button>
                                        <DrawerClose as-child>
                                            <Button variant="outline">
                                                Cancel
                                            </Button>
                                        </DrawerClose>
                                    </DrawerFooter>
                                </div>
                            </DrawerContent>
                        </Drawer>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
